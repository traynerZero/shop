<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    //

    public function index()
    {
        
        $product = Product::where([['status','=','0'],['stocks','>','0']])->get();

        return view("index")->with('data',$product);

    }

}
