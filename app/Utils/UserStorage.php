<?php

namespace App\Utils;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use OAuth2\Storage\UserCredentialsInterface;

/**
 * Custom logic for password grant type.
 *
 * @author  Diego Álvarez
 */
class UserStorage implements UserCredentialsInterface
{
    /**
     * Grant access tokens for basic user credentials.
     *
     * Check the supplied username and password for validity.
     *
     * You can also use the $client_id param to do any checks required based
     * on a client, if you need that.
     *
     * Required for OAuth2::GRANT_TYPE_USER_CREDENTIALS.
     *
     * @param $username
     * Username to be check with.
     * @param $password
     * Password to be check with.
     *
     * @return
     * TRUE if the username and password are valid, and FALSE if it isn't.
     * Moreover, if the username and password are valid, and you want to
     *
     * @see http://tools.ietf.org/html/rfc6749#section-4.3
     *
     * @ingroup oauth2_section_4
     */
    public function checkUserCredentials($email, $password)
    {
        if (Auth::once(['email' => $email, 'password' => $password])) {
            return true;
        }

        return false;
    }

    /**
     * @return
     * ARRAY the associated "user_id" and optional "scope" values
     * This function MUST return FALSE if the requested user does not exist or is
     * invalid. "scope" is a space-separated list of restricted scopes.
     * @code
     * return array(
     *     "user_id"  => USER_ID,    // REQUIRED user_id to be stored with the authorization code or access token
     *     "scope"    => SCOPE       // OPTIONAL space-separated list of restricted scopes
     * );
     * @endcode
     */
    public function getUserDetails($email)
    {
        $user = User::where('email', $email)->first();

        // user doesn't exist
        if (!$user) {
            return false;
        }

        return [
            'user_id' => $user->id,
            'scope' => 'user',
        ];
    }
}
