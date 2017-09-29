<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Create a new API user.
     *
     * @param   Request  $request
     * @return  array
     */
    public function create(Request $request)
    {
        $this->checkCredentials();

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
        ]);

        $userData = $request->all();

        $user = new User($userData);
        $user->password = bcrypt($userData['password']);
        $user->save();

        return $user->toArray();
    }
}
