<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class User_bet extends Model
{
  /**
   * The database table used by the model.
   *
   * @var string
   */
  protected $table = 'user_bets';

  /**
   * The database primary key value.
   *
   * @var string
   */
  protected $primaryKey = 'id';

  /**
   * Attributes that should be mass-assignable.
   *
   * @var array
   */
  protected $fillable = ['user_id', 'match_id', 'score_team1_op1', 'score_team2_op1', 'score_team1_op2', 'score_team2_op2', 'points'];

  public function matchinfo()
  {
    return $this->hasOne(Matches::Class, 'match_id', 'match_id');
  }
  public function user()
  {
    return $this->hasOne(User::Class, 'id', 'user_id');
  }
}