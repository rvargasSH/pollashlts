<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Matches;
use App\Models\Round;
use App\Models\Team;
use App\Models\groups;
use App\Models\User;
use App\Models\User_bet;
use App\Models\RankingUsers;
use App\Models\RankingDeparments;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Request as Input;
use Excel;
use Mail;

class RankingController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sql = "SELECT r.*,u.* FROM raking_user r JOIN users u on u.id=r.user_id ORDER BY r.points DESC, u.name ASC";
        $users_ranking = DB::select($sql);
        $user = Auth::user();
        $ranking_worldcup = Storage::disk('rankingworldcup')->files();
        $i = 0;
        foreach ($ranking_worldcup as $key => $value) {
            $ranking_worldcup[$i] = $value;
            $i++;
        }

        #validate if the current user is in the ranking, if isn´t the sistem won´t show data of ranking.
        $userinranking = RankingUsers::where('user_id', $user->id)->first();
        if ($userinranking == NULL) {
            $data = array(
                'show'  => 0,
                'currentuser' => $user,
                'message' => "Usted no ha participado en ninguna polla",
                'hiddemenu' => $this->validateuser(),
                'ranking_worldcup' => $ranking_worldcup,
            );
        } else {
            $i = 1;
            $a = 0;
            foreach ($users_ranking as $key => $user_ranking) {
                $sql = "SELECT count(b.user_id) as total_bets
                from user_bets b 
                join matches m on m.match_id=b.match_id and  m.status=2 
                where b.user_id=$user_ranking->user_id";
                $total_bets = DB::select($sql);
                $users_ranking[$a]->bets = $total_bets[0]->total_bets;
                $users_ranking[$a]->position = $i;
                if ($user_ranking->user_id == $user->id) {
                    $position = $i;
                    $rankininfouser = $user_ranking;
                }
                $i++;
                $a++;
            }
            $deparments_ranking = RankingDeparments::orderBy('points', 'DESC')->get();
            $data = array(
                'show'  => 1,
                'message' => "",
                'rankingUsers' => $users_ranking,
                'user_position' => $position,
                'user_ranking' => $rankininfouser,
                'deparments_ranking' => $deparments_ranking,
                'currentuser' => $user,
                'totalregister' => (count($users_ranking) < 10) ? count($users_ranking) : 10,
                'hiddemenu' => $this->validateuser(),
                'ranking_worldcup' => $ranking_worldcup,
            );
        }
        // if($user->email=='portela.john@locatelcolombia.com')
        // {
        //    $this->get_ranking_file($data); 
        // }

        return view('ranking.ranking')->with($data);
    }
    public function edit(Request $request, $id)
    {
        $perPage = 10;
        $sql = "SELECT  b.*,u.name as user_name,r.name as round_name,t.name as team1_name,t2.name as team2_name,m.score_team1, m.score_team2
         from user_bets b 
         join matches m on m.match_id=b.match_id and  m.status=2 
         join users u on u.id=b.user_id
         join rounds r on r.id=m.round_id 
         join teams t on t.id=m.id_team1
         join teams t2 on t2.id=m.id_team2
         where b.user_id=$id
         order by m.match_date desc";
        $user_bets = DB::select($sql);
        $user_bets = $this->arrayPaginator($user_bets, $request);
        $data = array('user_bets' => $user_bets, 'hiddemenu' => $this->validateuser(),);
        return view('ranking.user_points')->with($data);
    }
    public function upfiles(Request $request)
    {
        $file = $request->file('file');
        $nombre = $file->getClientOriginalName();
        Storage::disk('public')->put('rankingworldcup',  $request->file('file'));
        return redirect('dashboard')->with('flash_message', 'User Updated!');
    }
    public function arrayPaginator($array, $request)
    {
        $page = Input::get('page', 1);
        $perPage = 10;
        $offset = ($page * $perPage) - $perPage;

        return new LengthAwarePaginator(
            array_slice($array, $offset, $perPage, true),
            count($array),
            $perPage,
            $page,
            ['path' => $request->url(), 'query' => $request->query()]
        );
    }
    public function get_ranking_file($data)
    {
        // Excel::create('Ranking_Primera_Ronda', function ($excel) use ($data) {
        //     $excel->setTitle('no title');
        //     $excel->setCreator('no no creator')->setCompany('no company');
        //     $excel->setDescription('Ranking');
        //     $datasend[0] = array('Posición', 'Nombre', 'Puntos', 'Partidos Apostados');
        //     $namesheet = 'Ranking Usuarios';
        //     $excel->sheet($namesheet, function ($sheet) use ($data) {
        //         $a = 1;
        //         foreach ($data['rankingUsers'] as $key => $user) {
        //             $datasend[$a] = array($user->position, $user->name, $user->points, $user->bets);
        //             $a++;
        //         }
        //         $sheet->fromArray($datasend, null, 'A1', false, false);
        //         $sheet->cells('A1:D1', function ($cells) {
        //             $cells->setBackground('#AAAAFF');
        //         });
        //     });

        //     $datasend[0] = array('Posición', 'Nombre', 'Promedio');
        //     $namesheet = 'Ranking Dependencias';
        //     $excel->sheet($namesheet, function ($sheet) use ($data) {
        //         $a = 1;
        //         foreach ($data['deparments_ranking'] as $key => $deparmentrank) {
        //             $datasend[$a] = array($a, $deparmentrank->deparment->name, $deparmentrank->points);
        //             $a++;
        //         }
        //         $sheet->fromArray($datasend, null, 'A1', false, false);
        //         $sheet->cells('A1:C1', function ($cells) {
        //             $cells->setBackground('#AAAAFF');
        //         });
        //     });
        // })->export('xls');
        // $mail_send[0]="vargas.reynaldo@locatelcolombia.com";
        // Mail::send('mail.message',$mail_send,function($message) use ($file,$mail_send){
        //     $message->from('noreply@locatelcolombia.com','Polla Locatel');
        //     $message->subject('Prueba Polla Locatel');
        //     $message->to($mail_send,'Polla Locatel');
        //     $message->attach($file->store("xls",false,true)['full']);
        // });
    }
}