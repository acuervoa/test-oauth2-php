<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Actor extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'actor';

    /**
     * The table primary key.
     *
     * @var string
     */
    protected $primaryKey = 'actor_id';
}
