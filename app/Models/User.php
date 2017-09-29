<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Film votes.
     */
    public function films()
    {
        return $this->belongsToMany('App\Models\Film', 'film_user', 'user_id', 'film_id')
            ->withPivot('vote');
    }

    /**
     * Actor votes.
     */
    public function actors()
    {
        return $this->belongsToMany('App\Models\Actor', 'actor_user', 'user_id', 'actor_id')
            ->withPivot('vote');
    }
}
