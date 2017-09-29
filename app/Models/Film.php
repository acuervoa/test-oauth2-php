<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'film';

    /**
     * The table primary key.
     *
     * @var string
     */
    protected $primaryKey = 'film_id';
}
