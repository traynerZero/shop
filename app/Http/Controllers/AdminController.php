<?php

namespace App\Http\Controllers;

use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    //

    public function index()
    {
        
        $transactions = DB::table('transaction')
        ->join('users', 'transaction.user_id', '=', 'users.userid')
        ->where("status","=","1")-get();

        return view("admin")->with('data',$transactions);

    }

}
