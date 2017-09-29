<?php

namespace App\Http\Controllers;

use App\Models\Actor;
use App\Models\Film;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PrivateAreaController extends Controller
{
    /**
     * Get current user data.
     *
     * @param   Request  $request
     * @return  array
     */
    public function get(Request $request)
    {
        $user = $this->checkCredentials('user');

        return $user->toArray();
    }

    /**
     * Returns all films voted by user.
     *
     * @param   Request  $request
     * @return  array
     */
    public function indexFilms(Request $request)
    {
        $user = $this->checkCredentials('user');

        return $user->films->toArray();
    }

    /**
     * Returns all actors voted by user.
     *
     * @param   Request  $request
     * @return  array
     */
    public function indexActors(Request $request)
    {
        $user = $this->checkCredentials('user');

        return $user->actors->toArray();
    }

    /**
     * Add a vote for a certain film.
     *
     * @param   Request  $request
     * @return  array
     */
    public function voteFilm(Request $request)
    {
        $user = $this->checkCredentials('user');

        $vote = $request->input('vote');
        $filmId = $request->input('film_id');

        if ($user->films->contains($filmId)) {
            $user->films()->detach($filmId);
        }

        if ($vote !== null) {
            $user->films()->attach($filmId, ['vote' => $vote]);
        }

        $user->load('films');

        return $user->films->toArray();
    }

    /**
     * Add a vote for a certain actor.
     *
     * @param   Request  $request
     * @return  array
     */
    public function voteActor(Request $request)
    {
        $user = $this->checkCredentials('user');

        $vote = $request->input('vote');
        $actorId = $request->input('actor_id');

        if ($user->actors->contains($actorId)) {
            $user->actors()->detach($actorId);
        }

        if ($vote !== null) {
            $user->actors()->attach($actorId, ['vote' => $vote]);
        }

        $user->load('actors');

        return $user->actors->toArray();
    }
}
