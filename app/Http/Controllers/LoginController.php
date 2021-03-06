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
   

    public function signIn(Request $request){
        session_start();
        $email = $request->input('email');
        $pass = $request->input('password');
        session("userlogged",0);

        $user = Users::where([['email','=',$email], ['password','=',$pass], ['status','=',0]])->first();

        if(!empty($user->userid)){
            if($user->user_type == 1){

                $data = array(
                    'userid' => $user->userid,
                    'email' => $user->email,
                );
    
                session()->put('userdata', $data);
                session()->put('userlogged', $user->userid); 
                $request->session()->save(); 
                
                return redirect('/admin');

            }else{

                $data = array(
                    'userid' => $user->userid,
                    'email' => $user->email,
                );
    
                session()->put('userdata', $data);
                session()->put('userlogged', $user->userid); 
                $request->session()->save(); 
                
                return redirect('/');

            }
        }else{
            $request->session()->flash('error', 'Incorrect Email/Password.');
            return back();
        }

    }

    public function signUp(Request $request){

        $email = $request->input('reg_email');
        $pass = $request->input('reg_pass');
        $cfpass =$request->input('reg_cfpass');

        if(trim($pass) != trim($cfpass)){
            $request->session()->flash('reg_error', 'Password do not Match!');
                return back();
        }else{

            $user = new Users;
            $user->email = $email;
            $user->password = $pass;
            $user->firstname = "";
            $user->lastname = "";
            $user->user_type = 2;
            $user->status = 0;
            $user->save();

            $user = Users::where([['email','=',$email], ['password','=',$pass], ['status','=',0]])->first();
            $data = array(
                'userid' => $user->userid,
                'email' => $user->email,
            );

            session()->put('userdata', $data);
            session()->put('userlogged', $user->userid); 
            $request->session()->save(); 
            
            return redirect('/');

        }


    }

    public function logout(Request $request){

            $request->session()->forget('userdata');
            $request->session()->forget('userlogged'); 
            $request->session()->flush(); 
                
            return redirect('/');


    }
}