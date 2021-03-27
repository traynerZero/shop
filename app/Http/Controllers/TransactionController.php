<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TransactionController extends Controller
{
    //

    public function clearCart(Request $request){
        $request->session()->forget('cart');
        $request->session()->flush();
    }

    public function viewCart(){
        echo json_encode(session()->get("cart"));
    }

    public function addtoCart(Request $request){

        $product_id = $request->input("id");

        if(!is_null(session()->get("cart"))){
            
            $cart = session()->get("cart");

            foreach($cart as $c){
                if($c[$product_id]['id'] == $product_id){
                    $c[$product_id]['quant'] += 1;
                    
                }else{
                    $data = array(
                        "id" => $product_id,
                        "quant" => 1
                    );
                    
                    $cart[$product_id] = $data;
                }
            }
            session()->put('cart', $cart);
        }else{
            //first item
            //initialize the cart

            $cart = array();
            $data = array(
                "id" => $product_id,
                "quant" => 1
            );
            
            $cart[$product_id] = $data;

            session()->put('cart', $cart);
        }

        $request->session()->save(); 
        echo json_encode(session()->get("cart"));

    }

}
