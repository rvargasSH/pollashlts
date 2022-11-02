<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NumberIdentification extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'num_documents';

    /**
     * The database primary key value.
     *
     * @var string
     */
    protected $primaryKey = 'num_identification';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
}