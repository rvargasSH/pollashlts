<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Matches;
use App\Models\Round;
use App\Models\PoliticAdmin;
use App\Models\RoundsPolitics;
use App\Models\Team;
use App\Models\Groups;
use App\Models\User;
use App\Models\User_bet;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Request as Input;

class HomeController extends Controller
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
    public function index(Request $request)
    {
        $user = Auth::user();
        if ($user->first_time == 0) {
            $data = array('user' => $user);
            return view('auth.register_first_time')->with($data);
        } elseif ($user->first_time == 2) {
            $data = array('user' => $user);
            return view('auth.complete_datos')->with($data);
        } else {
            date_default_timezone_set('America/Bogota');
            $datetoday = date('Y-m-d');
            $mod_date = strtotime($datetoday . "+ 1 days");
            $datetomorrow = date('Y-m-d', $mod_date);
            $hournow = date("H:i:s", strtotime('+1 hours'));
            $groups = 0;
            #get the use 
            #get all the matches from today and tomorrow and that haven't played yet
            $near_marches = Matches::where('status', '1')->whereBetween('match_date', [$datetoday, $datetomorrow])->orderBy('match_date', 'asc')->orderBy('match_hour', 'asc')->get();
            $i = 0;
            foreach ($near_marches as $key => $value) {
                $infoteam1 = Team::find($value->id_team1);
                $infoteam2 = Team::find($value->id_team2);
                #validate if the user saved scores to this match.
                $user_bet = User_bet::where('match_id', $value->match_id)->where('user_id', $user->id)->first();
                if ($user_bet != NULL) {
                    $near_marches[$i]->score_team1_op1 = $user_bet->score_team1_op1;
                    $near_marches[$i]->score_team2_op1 = $user_bet->score_team2_op1;
                    $near_marches[$i]->score_team1_op2 = $user_bet->score_team1_op2;
                    $near_marches[$i]->score_team2_op2 = $user_bet->score_team2_op2;
                } else {
                    $near_marches[$i]->score_team1_op1 = "";
                    $near_marches[$i]->score_team2_op1 = "";
                    $near_marches[$i]->score_team1_op2 = "";
                    $near_marches[$i]->score_team2_op2 = "";
                }
                if ($value->round_id == 1) {
                    $team1_group = groups::find($infoteam1->group_id);
                    $near_marches[$i]->group_name = $team1_group->name;
                } else {
                    $near_marches[$i]->group_name = "";
                }
                ($datetoday == $value->match_date && $hournow >= $value->match_hour) ? $near_marches[$i]->show = 0 : $near_marches[$i]->show = 1;
                $near_marches[$i]->name_team1 = $infoteam1->name;
                $near_marches[$i]->flag_team1 = "img/teams/" . $infoteam1->file_flag . ".png";
                $near_marches[$i]->name_team2 = $infoteam2->name;
                $near_marches[$i]->flag_team2 = "img/teams/" . $infoteam2->file_flag . ".png";
                $i++;
            }
            $sql = "SELECT m.*,b.score_team1_op1,b.score_team2_op1,b.score_team1_op2,b.score_team2_op2,g.name as group_name,t.name as name_team1,t.file_flag as flag_team1,t2.name as name_team2,t2.file_flag as flag_team2
            from matches m 
            left join user_bets b on b.match_id=m.match_id and b.user_id=$user->id
            join teams t on t.id=m.id_team1
            join teams t2 on t2.id=m.id_team2
            left join groups g on g.id=t.group_id
            where m.status='1' and m.match_date>='" . $datetoday . "'
            group by m.match_id,b.score_team1_op1,b.score_team2_op1,b.score_team1_op2,b.score_team2_op2,g.name,
            t.name,t.file_flag,t2.name,t2.file_flag order by group_name asc, m.match_date asc, m.match_hour asc";
            $next_matches = DB::select($sql);
            $next_matches = $this->arrayPaginator($next_matches, $request);
            foreach ($next_matches as $key => $value) {
                ($datetoday == $value->match_date && $hournow >= $value->match_hour) ? $value->show = 0 : $value->show = 1;
                $value->flag_team1 = "img/teams/" . $value->flag_team1 . ".png";
                $value->flag_team2 = "img/teams/" . $value->flag_team2 . ".png";
            }

            $data = array(
                'near_marches'  => $near_marches,
                'next_matches' => $next_matches,
                'hournow' => $hournow,
                'hiddemenu' => $this->validateuser(),
            );

            return view('dashboard')->with($data);
        }
    }
    #Here Updated the user who get in the first time to the system.
    public function updateUser()
    {
        $userupdated = user::find($_POST['user_updated']);
        $userupdated->name = $_POST['name'];
        $userupdated->password = bcrypt($_POST['password']);
        $userupdated->first_time = 1;
        $userupdated->save();
        return redirect('dashboard')->with('flash_message', 'User Updated!');
    }

    #Show the politics aply to calculate the scores to each contestant an each deparment
    public function showpolitics()
    {
        $rounds = Round::all();
        foreach ($rounds as $key => $round) {
            $politics = RoundsPolitics::where('id_round', $round->id)->orderBy('id_politic', 'ASC')->get();
            $data_first_politic = [];
            $a = 0;
            for ($i = 0; $i < count($politics); $i++) {

                if (isset($politics[$i + 1]) && $politics[$i]->id_politic == $politics[$i + 1]->id_politic) {
                    $data_first_politic[$a]['politic_name'] = $politics[$i]->politicInfo->politic_name;
                    $data_first_politic[$a]['politic_number'] = $politics[$i]->politicInfo->politic_number;
                    if ($politics[$i]->user_opcion == 1) {
                        $data_first_politic[$a]['points_op_one'] = $politics[$i]->points;
                    }
                    if ($politics[$i + 1]->user_opcion == 1) {
                        $data_first_politic[$a]['points_op_one'] = $politics[$i + 1]->points;
                    }
                    if ($politics[$i]->user_opcion == 2) {
                        $data_first_politic[$a]['points_op_two'] = $politics[$i]->points;
                    }
                    if ($politics[$i + 1]->user_opcion == 2) {
                        $data_first_politic[$a]['points_op_two'] = $politics[$i + 1]->points;
                    }

                    $a++;
                }
            }
            $round->politics = $data_first_politic;
        }

        $data = array('rounds' => $rounds, 'hiddemenu' => $this->validateuser());
        return view('politics.politics')->with($data);
    }
    public function helpfiles()
    {
        $helpfiles = Storage::disk('public/help')->files();
        $i = 0;
        foreach ($helpfiles as $key => $value) {
            $helpfiles[$i] = "../uploads/helpfiles/" . $value;
            $i++;
        }
        $data = array(
            'hiddemenu' => $this->validateuser(),
            'helpfiles' => $helpfiles,
        );
        return view('help.help')->with($data);
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

    #Here Updated the user who get in the first time to the system.
    public function updateUserDatos()
    {
        $userupdated = user::find($_POST['user_updated']);
        $userupdated->name = $_POST['name'];
        $userupdated->identification_number = $_POST['identification_id'];
        $userupdated->first_time = 1;
        $userupdated->save();
        return redirect('dashboard')->with('flash_message', 'User Updated!');
    }
}