<?php

namespace App\Http\Controllers;

use App\Users;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return Response
     */
    public function test()
    {
        return view('login', ['user' => Users::where('userid', '1')->first()]);
    }
}