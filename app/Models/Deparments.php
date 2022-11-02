<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Deparments extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'deparments';

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
}