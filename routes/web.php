<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Matches\MatchesController;
use App\Http\Controllers\Teams\TeamsController;
use App\Http\Controllers\RankingController;
use App\Http\Controllers\Rounds\RoundsController;
use App\Http\Controllers\UserBets\User_betsController;
use App\Http\Controllers\politicnanager\PoliticAdminController;
use App\Http\Controllers\UserAdmon\UserAdmonController;
use App\Http\Controllers\Controller;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', function () {
    return view('auth.login');
});
Route::group(['middleware' => 'auth'], function () {

    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
    Route::resource('/matches/matches', MatchesController::class);
    Route::resource('/teams/teams', TeamsController::class);
    Route::resource('/ranking/ranking', RankingController::class);
    Route::resource('/rounds/rounds', RoundsController::class);
    Route::resource('/user_bets/user_bets', User_betsController::class);
    Route::post('user_bets/user_bets', [User_betsController::class, 'saveBet']);
    Route::post('updateuser', [HomeController::class, 'updateUser']);
    Route::post('updateusernumber', [HomeController::class, 'updateUserDatos']);
    Route::get('home/politics', [HomeController::class, 'showpolitics']);
    Route::get('home/help', [HomeController::class, 'helpfiles']);
    Route::post('/ranking/upfiles', [RankingController::class, 'upfiles']);
    Route::resource('politicmanager/politic-admin', PoliticAdminController::class);
    Route::post('politicmanager/setpoints/getpoints', [PoliticAdminController::class, 'getpoints']);
    Route::post('politicmanager/setpoints/savepoints', [PoliticAdminController::class, 'savepoints']);
    Route::get('politicmanager/setpoints/{points}', [PoliticAdminController::class, 'setpoints']);
    Route::resource('UserAdmon/user-admon', UserAdmonController::class);
    Route::post('user/validateid', [Controller::class, 'validateuser']);
});

require __DIR__ . '/auth.php';