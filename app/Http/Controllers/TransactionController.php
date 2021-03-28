<?php

namespace App\Http\Controllers;

use App\Product;
use App\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    //

    public function clearCart(Request $request){
        $request->session()->forget('cart');
        $request->session()->flush();
    }

    public function viewCart(Request $request){
        $cart = session()->get("cart");
        $ids = array();
        foreach($cart as $c){
            array_push($ids,$c['id']);
        }

        $product = Product::whereIn('product_id',$ids)->get();

        $data = array();
        foreach($cart as $c){
            foreach($product as $prod){
                
                if($c['id'] == $prod->product_id){

                    $d = array(
                        "prod_id" => $prod->product_id,
                        "prod_name" => $prod->product_name,
                        "prod_description" => $prod->product_description,
                        "price" => $prod->price,
                        "quantity" => $c['quant'],
                        "total" => $prod->price * $c['quant']
                    );

                    array_push($data,$d);

                }

            }
        }

        session()->put('checkout_data', $data);
        $request->session()->save(); 

        return view('modal')->with('data',$data);
    }

    public function addtoCart(Request $request){

        $product_id = $request->input("id");

        if(!is_null(session()->get("cart"))){
            
            $cart = session()->get("cart");

            if(isset($cart[$product_id])){
                $cart[$product_id]['quant'] += 1;
            }else{
                $data = array(
                    "id" => $product_id,
                    "quant" => 1
                );
                
                $cart[$product_id] = $data;
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

    public function checkout(){
        $cart = session()->get("checkout_data");
        
        return view('checkout')->with('data',$cart);
    }

    public function saveOrder(Request $request){

        if(!is_null(session()->get('userlogged'))){
        //user logged in
        $userid = session()->get('userlogged');
        $cart = session()->get("checkout_data");

        $total_amount = 0;
        foreach($cart as $c){
            $total_amount += $c['total'];

            Product::where("product_id","=",$c['prod_id'])->decrement('stocks',$c['quantity']);

        }
        
        $transaction = new Transaction;
        $transaction->user_id = $userid;
        $transaction->products = json_encode($cart);
        $transaction->total_amount = $total_amount;
        $transaction->status = 1;
        $transaction->save();

        $request->session()->forget('cart');
        $request->session()->forget('checkout_data');
        $request->session()->flush();

        return redirect('/');

        }else{
            //login first
        }


    }

}
