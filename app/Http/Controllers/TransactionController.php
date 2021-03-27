<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TransactionController extends Controller
{
    //

    public function addtoCart(Request $request){

        $product_id = $request->input("id");

        if(!is_null(session()->get("cart"))){
            
            $cart = session()->get("cart");

            
            foreach($cart as $c){
                echo $c['id'];
            }

        }else{
            //first item
            //initialize the cart

            $cart = array();
            $data = array(
                "id" => $product_id,
                "quant" => 1
            );
            
            array_push($cart,$data);

            session()->put('cart', $cart);
        }

        echo json_encode(session()->get("cart"));
    }

}
