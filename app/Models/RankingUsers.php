<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class RankingUsers extends Model
{
  /**
   * The database table used by the model.
   *
   * @var string
   */
  protected $table = 'raking_user';

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
  protected $fillable = ['id', 'user_id', 'points'];

  public function user()
  {
    return $this->hasOne(User::Class, 'id', 'user_id')->orderBy('name', 'ASC');
  }
}