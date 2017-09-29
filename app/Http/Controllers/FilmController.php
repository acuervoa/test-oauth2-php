<?php

namespace App\Http\Controllers;

use App\Models\Film;
use Illuminate\Http\Request;

class FilmController extends Controller
{
    /**
     * Returns all films stored in database.
     *
     * @param   Request $request
     * @return  array
     */
    public function index(Request $request)
    {
        $this->checkCredentials();

        return Film::all()->toArray();
    }

    /**
     * Gets the film info given its id.
     *
     * @param   Request $request
     * @param   string  $filmId
     * @return  array
     */
    public function get(Request $request, $filmId)
    {
        $this->checkCredentials();

        return Film::find($filmId)->toArray();
    }
}
