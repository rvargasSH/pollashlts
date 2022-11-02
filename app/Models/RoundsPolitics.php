<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\PoliticAdmin;

class RoundsPolitics extends Model
{
  /**
   * The database table used by the model.
   *
   * @var string
   */
  protected $table = 'round_politics';

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
  protected $fillable = ['id_round', 'id_politic', 'user_opcion', 'points'];

  public function politicInfo()
  {
    return $this->hasOne(PoliticAdmin::Class, 'politic_id', 'id_politic');
  }
}