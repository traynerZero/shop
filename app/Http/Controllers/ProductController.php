<?php

namespace App\Http\Controllers;

use App\Product;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return Response
     */
    public function index()
    {
        
        $product = Product::where('status','0')->get();

        return view("index")->with('data',$product);

    }
}