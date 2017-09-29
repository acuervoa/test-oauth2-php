<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Utils\UserStorage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use OAuth2\GrantType\ClientCredentials;
use OAuth2\GrantType\UserCredentials;
use OAuth2\Request as OAuthRequest;
use OAuth2\Response as OAuthResponse;
use OAuth2\Server as OAuthServer;
use OAuth2\Storage\Pdo as OAuthPdo;

class Controller extends BaseController
{
    /**
     * Default Laravel traits for main controller.
     */
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * This contains the main storage for the OAuth server.
     *
     * @var  OAuthPdo
     */
    protected $oauthStorage;

    /**
     * Init OAuth server and set grant types.
     *
     * @return  OAuthServer
     */
    protected function startOauthServer()
    {
        $dsn = "mysql:host=" . env('DB_HOST');
        $dsn .= ";port=" . env('DB_PORT');
        $dsn .= ";dbname=" . env('DB_DATABASE');
        $username = env('DB_USERNAME');
        $password = env('DB_PASSWORD');

        $this->oauthStorage = new OAuthPdo([
            'dsn' => $dsn,
            'username' => $username,
            'password' => $password,
        ]);

        $server = new OAuthServer($this->oauthStorage);
        $server->addGrantType(new ClientCredentials($this->oauthStorage));
        $server->addGrantType(new UserCredentials(new UserStorage()));

        return $server;
    }

    /**
     * Check OAuth credentials when recieving a request.
     *
     * @param   string  $scope
     * @return  User|null
     */
    protected function checkCredentials($scope = null)
    {
        $server = $this->startOauthServer();

        $request = OAuthRequest::createFromGlobals();
        $response = new OAuthResponse();

        if (!$server->verifyResourceRequest($request, $response, $scope)) {
            $response->send();
            die;
        }

        $getTokenData = $server->getAccessTokenData($request);
        if (isset($getTokenData['user_id'])) {
            return User::find($getTokenData['user_id']);
        }

        return null;
    }
}
