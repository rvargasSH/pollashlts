<?php

namespace App\Http\Controllers\Matches;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Matches;
use App\Models\Round;
use App\Models\PoliticAdmin;
use App\Models\RoundsPolitics;
use App\Models\Team;
use App\Models\User_bet;
use App\Models\User;
use App\Models\RankingUsers;
use App\Models\RankingDeparments;
use App\Models\Deparments;
use Illuminate\Http\Request;
use Mail;
use Illuminate\Support\Facades\Log;

class MatchesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 10;
        if (!empty($keyword)) {
            $Matcheses = Matches::where('match_id', 'LIKE', "%$keyword%")
                ->orWhere('match_date', 'LIKE', "%$keyword%")
                ->orWhere('match_hour', 'LIKE', "%$keyword%")
                ->orWhere('status', 'LIKE', "%$keyword%")
                ->orWhere('score_team1', 'LIKE', "%$keyword%")
                ->orWhere('score_team2', 'LIKE', "%$keyword%")
                ->orderBy('status', 'asc')
                ->orderBy('match_date', 'asc')
                ->paginate($perPage);
        } else {
            $Matcheses = Matches::orderBy('status', 'asc')->orderBy('match_date', 'asc')->paginate($perPage);
        }
        $i = 0;
        foreach ($Matcheses as $key => $Matches) {
            $infoteam1 = Team::find($Matches->id_team1);
            $infoteam2 = Team::find($Matches->id_team2);
            $Matcheses[$i]->Matches_score = $Matches->score_team1 . "-" . $Matches->score_team2;
            $Matcheses[$i]->name_team1 = $infoteam1->name;
            $Matcheses[$i]->name_team2 = $infoteam2->name;
            $i++;
        }
        $data = array('matches' => $Matcheses, 'hiddemenu' => $this->validateuser(),);
        return view('matches.matches.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $rounds = Round::all();
        $teams = Team::where('status', 1)->orderBy('name', 'ASC')->get();
        $data = array('teams' => $teams, 'rounds' => $rounds, 'hiddemenu' => $this->validateuser(),);
        return view('matches.matches.create')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {

        $requestData = $request->all();
        Matches::create($requestData);
        return redirect('matches/matches')->with('flash_message', 'Matches added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $Matches = Matches::findOrFail($id);
        $round = Round::where('id', $Matches->round_id)->first();
        $team1 = Team::where('id', $Matches->id_team1)->first();
        $team2 = Team::where('id', $Matches->id_team2)->first();
        $data = array(
            'round'  => $round,
            'match' => $Matches,
            'teams1_name' => $team1->name,
            'teams2_name' => $team2->name,
            'hiddemenu' => $this->validateuser()
        );
        return view('matches.matches.show')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $Matches = Matches::findOrFail($id);
        $rounds = Round::all();
        $teams = Team::where('status', 1)->orderBy('name', 'ASC')->get();
        $data = array(
            'rounds'  => $rounds,
            'match' => $Matches,
            'teams' => $teams,
            'hiddemenu' => $this->validateuser()

        );
        return view('matches.matches.edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $requestData = $request->all();
        $Matches = Matches::findOrFail($id);
        #search the roudn from this Matches to get the points acording whit each politic.
        $round = Round::find($requestData['round_id']);
        $Matches->update($requestData);
        if ($requestData['status'] == 2) {
            $bets = User_bet::where('match_id', $requestData['match_id'])->get();
            foreach ($bets as $key => $user) {
                $points = $this->generateUsersRanking($requestData['score_team1'], $requestData['score_team2'], $user, $round);
                $infouser = User::find($user->user_id);
                $user->points = $points;
                $user->save();
                #Add the points from the current user in the table ranking_user.

                $rankinguser = RankingUsers::where('user_id', $user->user_id)->first();
                if ($rankinguser != NULL) {
                    #get all the bets from the current user and get the points from theses.
                    $betsbyuser = User_bet::where('user_id', $user->user_id)->get();
                    $poitsuser = 0;
                    foreach ($betsbyuser as $key => $userbet) {
                        $poitsuser += $userbet->points;
                    }
                    $rankinguser->points = $poitsuser;
                    $rankinguser->save();
                } else {
                    $newinranking = new RankingUsers();
                    $newinranking->user_id = $user->user_id;
                    $newinranking->points = $points;
                    $newinranking->save();
                }
            }
            #This generate the average to each deparment acording whit the point of each of their users.
            $this->deparment_average();
        }

        return redirect('matches/matches')->with('flash_message', 'Matches updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Matches::destroy($id);

        return redirect('matches.matches')->with('flash_message', 'Matches deleted!');
    }
    public function generateUsersRanking($scoreteam1, $scoreteam2, $userdata, $round)
    {
        $points = 0;
        $politics = RoundsPolitics::where('id_round', $round->id)->orderBy('id_politic', 'ASC')->get();
        // dd($politics);        
        foreach ($politics as $key => $value) {
            if ($value->user_opcion == 1) {
                switch ($value->politicInfo->politic_number) {
                    case 1:
                        if ($userdata->score_team1_op1 == $scoreteam1 &&  $userdata->score_team2_op1 == $scoreteam2) $points += $value->points;
                        break;
                    case 2:

                        if ($userdata->score_team1_op1 == $userdata->score_team2_op1 && $scoreteam1 == $scoreteam2) $points += $value->points;


                        break;
                    case 3:
                        if ($userdata->score_team1_op1 == $scoreteam1) $points += $value->points;

                        break;
                    case 4:

                        if ($userdata->score_team2_op1 == $scoreteam2) $points += $value->points;

                        break;
                    case 5:

                        $validate = $this->calculatedifere($scoreteam1, $scoreteam2, $userdata->score_team1_op1, $userdata->score_team2_op1);
                        if ($validate) $points += $value->points;

                        break;
                    case 6:

                        if ($scoreteam1 > $scoreteam2 && $userdata->score_team1_op1 > $userdata->score_team2_op1) $points += $value->points;
                        if ($scoreteam2 > $scoreteam1 && $userdata->score_team2_op1 > $userdata->score_team1_op1) $points += $value->points;

                        break;
                }
            } else {
                switch ($value->politicInfo->politic_number) {
                    case 1:

                        if ($userdata->score_team1_op2 == $scoreteam1 &&  $userdata->score_team2_op2 == $scoreteam2) $points += $value->points;

                        break;
                    case 2:

                        if ($userdata->score_team1_op2 == $userdata->score_team2_op2 && $scoreteam1 == $scoreteam2) $points += $value->points;



                        break;
                    case 3:

                        if ($userdata->score_team1_op2 == $scoreteam1) $points += $value->points;


                        break;
                    case 4:

                        if ($userdata->score_team2_op2 == $scoreteam2) $points += $value->points;


                        break;
                    case 5:

                        $validate = $this->calculatedifere($scoreteam1, $scoreteam2, $userdata->score_team1_op2, $userdata->score_team2_op2);
                        if ($validate) $points += $value->points;

                        break;
                    case 6:

                        if ($scoreteam1 > $scoreteam2 && $userdata->score_team1_op2 > $userdata->score_team2_op2) $points += $value->points;
                        if ($scoreteam2 > $scoreteam1 && $userdata->score_team2_op2 > $userdata->score_team1_op2) $points += $value->points;

                        break;
                }
            }
        }
        return $points;
    }
    public function deparment_average()
    {
        $deparments = Deparments::all();
        foreach ($deparments as $key => $deparment) {
            $userbydeparment = User::where('deparment_id', $deparment->id)->get();
            $i = 0;
            $pointsbydeparment = 0;
            $pointsranking = 0;
            foreach ($userbydeparment as $key => $user) {
                $rankinguser = RankingUsers::where('user_id', $user->id)->first();
                if ($rankinguser != NULL) {
                    $pointsbydeparment += $rankinguser->points;
                    $i++;
                }
            }
            if ($i > 0 && $pointsbydeparment > 0) {
                $pointsranking = number_format($pointsbydeparment / $i, 2);
                $deparmentranking = RankingDeparments::where('deparment_id', $deparment->id)->first();
                if ($deparmentranking != NULL) {
                    $deparmentranking->points = $pointsranking;
                    $deparmentranking->save();
                } else {
                    $newinranking = new RankingDeparments;
                    $newinranking->deparment_id = $deparment->id;
                    $newinranking->points = $pointsranking;
                    $newinranking->save();
                }
            }
        }
    }

    public function sendMessage()
    {
        date_default_timezone_set('America/Bogota');
        $datetoday = 'Y-m-d';
        $hournow = date("H:i", strtotime('+30 minutes'));
        $Matches_now = Matches::where('Matches_date', $datetoday)->where('Matches_hour', $hournow)->get();
        // $file = Excel::create('Resultados', function ($excel) use ($Matches_now) {
        //     $excel->setTitle('no title');
        //     $excel->setCreator('no no creator')->setCompany('no company');
        //     $excel->setDescription('Resultados Polla');
        //     foreach ($Matches_now as $key => $value) {
        //         $namesheet = substr($value->nameteam1->name, 0, 3) . "-" . substr($value->nameteam2->name, 0, 3);
        //         $data = [];
        //         $Matchesnamefirstop = $value->nameteam1->name . " vs " . $value->nameteam2->name . " Opcion Uno";
        //         $Matchesnamesecondop = $value->nameteam1->name . " vs " . $value->nameteam2->name . " Opcion Dos";
        //         $data[0] = array('Nombre Participante', $Matchesnamefirstop, $Matchesnamesecondop);
        //         $excel->sheet($namesheet, function ($sheet) use ($value, $data) {
        //             $a = 1;
        //             foreach ($value->Matches_bets as $key => $user_bet) {
        //                 $scoreone = $user_bet->score_team1_op1 . "-" . $user_bet->score_team2_op1;
        //                 $scoretwo = $user_bet->score_team1_op2 . "-" . $user_bet->score_team2_op2;

        //                 $data[$a] = array($user_bet->user->name, $scoreone, $scoretwo);
        //                 $a++;
        //             }
        //             $sheet->fromArray($data, null, 'A1', false, false);
        //             $sheet->cells('A1:C1', function ($cells) {
        //                 $cells->setBackground('#AAAAFF');
        //             });
        //         });
        //     }
        // });
        // $mail_send = [];
        // $a = 0;
        // foreach ($Matches_now as $key => $value) {
        //     foreach ($value->Matches_bets as $key => $user_bet) {
        //         $mail_send[$a] = $user_bet->user->email;
        //         $a++;
        //     }
        // }
        // if (count($mail_send) > 0) {
        //     $mail_send[$a + 1] = "vargas.reynaldo@locatelcolombia.com";
        //     Mail::send('mail.message', $mail_send, function ($message) use ($file, $mail_send) {
        //         $message->from('noreply@locatelcolombia.com', 'Polla Locatel');
        //         $message->subject('Prueba Polla Locatel');
        //         $message->to($mail_send, 'Polla Locatel');
        //         $message->attach($file->store("xls", false, true)['full']);
        //     });
        //     Log::info('Mails Sent');
        // }
    }

    public function calculatedifere($resul1, $resul2, $uresul1, $uresul2)
    {
        if ($resul1 > $resul2) $diferencegame = $resul1 - $resul2;
        if ($resul2 > $resul1) $diferencegame = $resul2 - $resul1;
        if ($resul1 == $resul2) $diferencegame = 0;
        if ($uresul1 > $uresul2) $diferenceuser = $uresul1 - $uresul2;
        if ($uresul1 < $uresul2) $diferenceuser = $uresul2 - $uresul1;
        if ($uresul1 == $uresul2) $diferenceuser = 0;
        if ($diferencegame == $diferenceuser) return true;
    }
}