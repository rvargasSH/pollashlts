<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class RankingDeparments extends Model
{
  /**
   * The database table used by the model.
   *
   * @var string
   */
  protected $table = 'raking_deparment';

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
  protected $fillable = ['id', 'deparment_id', 'points'];

  public function deparment()
  {
    return $this->hasOne(Deparments::Class, 'id', 'deparment_id');
  }
}