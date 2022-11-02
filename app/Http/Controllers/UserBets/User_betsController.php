<?php

namespace App\Http\Controllers\UserBets;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\User_bet;
use App\Models\Matches;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class User_betsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $user_bets = User_bet::where('user_id', 'LIKE', "%$keyword%")
                ->orWhere('match_id', 'LIKE', "%$keyword%")
                ->orWhere('score_team1_op1', 'LIKE', "%$keyword%")
                ->orWhere('score_team2_op1', 'LIKE', "%$keyword%")
                ->orWhere('score_team1_op2', 'LIKE', "%$keyword%")
                ->orWhere('score_team2_op2', 'LIKE', "%$keyword%")
                ->orWhere('points', 'LIKE', "%$keyword%")
                ->paginate($perPage);
        } else {
            $user_bets = User_bet::paginate($perPage);
        }

        return view('user_bets.user_bets.index', compact('user_bets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('user_bets.user_bets.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function saveBet()
    {
        date_default_timezone_set('America/Bogota');

        #Validate the match date, to avoid that save info when it has already beging.
        $match_info = Matches::find($_POST['match_id']);
        $datetoday = date('Y-m-d');
        $hournow = date("H:i:s", strtotime('+1 hours'));
        $execute = 0;
        $message = "";
        if ($match_info->match_date <= $datetoday && $match_info->match_hour <= $hournow) {
            $message = "El partido está en juego o ya se jugó";
        } else {
            $user = Auth::user();
            #validate if the bet already exist, and update, in other case create a new one.
            $user_bet = User_bet::where('match_id', $_POST['match_id'])->where('user_id', $user->id)->first();
            if ($user_bet != NULL) {
                $user_bet->score_team1_op1 = $_POST['score_team1_op1'];
                $user_bet->score_team2_op1 = $_POST['score_team2_op1'];
                $user_bet->score_team1_op2 = $_POST['score_team1_op2'];
                $user_bet->score_team2_op2 = $_POST['score_team2_op2'];
                $user_bet->points = 0;
                $user_bet->update();
            } else {
                $newbet = new User_bet();
                $newbet->match_id = $_POST['match_id'];
                $newbet->user_id = $user->id;
                $newbet->score_team1_op1 = $_POST['score_team1_op1'];
                $newbet->score_team2_op1 = $_POST['score_team2_op1'];
                $newbet->score_team1_op2 = $_POST['score_team1_op2'];
                $newbet->score_team2_op2 = $_POST['score_team2_op2'];
                $newbet->points = 0;
                $newbet->save();
            }
            $execute = 1;
            $message = "Guardado con éxito";
        }
        $response = array('execute' => $execute, 'message' => $message);

        echo json_encode($response);
        exit;
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
        $user_bet = User_bet::findOrFail($id);

        return view('user_bets.user_bets.show', compact('user_bet'));
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
        $user_bet = User_bet::findOrFail($id);

        return view('user_bets.user_bets.edit', compact('user_bet'));
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

        $user_bet = User_bet::findOrFail($id);
        $user_bet->update($requestData);

        return redirect('user_bets/user_bets')->with('flash_message', 'User_bet updated!');
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
        User_bet::destroy($id);

        return redirect('user_bets/user_bets')->with('flash_message', 'User_bet deleted!');
    }
}