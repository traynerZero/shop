<?php

namespace App\Http\Controllers;

use App\Transaction;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //

    public function index()
    {
        
        $transactions = Transaction::where('status','1')->get();

        return view("admin")->with('data',$transactions);

    }

}
