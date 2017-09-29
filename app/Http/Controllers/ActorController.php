<?php

namespace App\Http\Controllers;

use App\Models\Actor;
use Illuminate\Http\Request;

class ActorController extends Controller
{
    /**
     * Returns all actors stored in database.
     *
     * @param   Request $request
     * @return  array
     */
    public function index(Request $request)
    {
        $this->checkCredentials();

        return Actor::all()->toArray();
    }

    /**
     * Gets the actor info given its id.
     *
     * @param   Request $request
     * @param   string  $actorId
     * @return  array
     */
    public function get(Request $request, $actorId)
    {
        $this->checkCredentials();

        return Actor::find($actorId)->toArray();
    }
}
