<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Team;
use App\Models\Round;
use App\Models\User_bet;


class Matches extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'matches';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'match_id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['match_date', 'match_hour', 'status', 'id_team1', 'id_team2', 'round_id', 'score_team1', 'score_team2'];

    public function nameteam1()
    {
        return $this->hasOne(Team::Class, 'id', 'id_team1');
    }
    public function nameteam2()
    {
        return $this->hasOne(Team::Class, 'id', 'id_team2');
    }
    public function roundname()
    {
        return $this->hasOne(Round::Class, 'id', 'round_id');
    }
    public function match_bets()
    {
        return $this->hasMany(User_bet::Class, 'match_id', 'match_id');
    }
}