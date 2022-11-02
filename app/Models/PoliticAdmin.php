<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PoliticAdmin extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'politics';

    /**
     * The database primary key value.
     *
     * @var string
     */
    protected $primaryKey = 'politic_id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['politic_name', 'politic_number', 'status'];
}