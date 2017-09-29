<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Test endpoint.
     *
     * @param   Request $request
     * @return  array
     */
    public function hello(Request $request)
    {
        return [
            'message' => 'Hi!',
        ];
    }

    /**
     * Generate a new OAuth token with given credentials.
     *
     * @param   Request $request
     * @return  array
     */
    public function generateToken(Request $request)
    {
        $server = $this->startOauthServer();

        $response = $server->handleTokenRequest(\OAuth2\Request::createFromGlobals());
        $response->send();
    }
}
