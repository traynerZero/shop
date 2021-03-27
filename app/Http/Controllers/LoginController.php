<?php

namespace App\Http\Controllers;

use App\Users;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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

    public function signIn(Request $request){

        $email = $request->input('email');
        $pass = $request->input('password');

        $user = Users::where([['email','=',$email], ['password','=',$pass], ['status','=',0]])->first();

        if(!empty($user->userid)){
            if($user->user_type == 1){

                $request->session()->flash('error', 'Invalid User! Please Contact Administrator.');
                return back();
            }
        }else{
            $request->session()->flash('error', 'Incorrect Email/Password.');
            return back();
        }

    }

    public function signUp(Request $request){

    }
}