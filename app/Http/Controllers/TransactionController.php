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
        $request->session()->forget('checkout_data');
        $request->session()->flush();

        return back();
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

    public function inputCardInfo(){
        return view('card');
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

        return view('/');

        }else{
            //login first
            $request->session()->flash('error_toast', 'Please Login First!.');
            return view('/login');
        }


    }

    public function connectMagpie(){
        $header = base64_encode('pk_test_JoAZxCrQclxmAwfPRrESow'. ':');

        $cardObj = array(
        "card" => array(
            "name" => "Juan de la Cruz",
            "number" => "4111111111111111",
            "exp_month" => 4,
            "exp_year" => 2025,
            "cvc" => "751"
        )
        );


        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.magpie.im/v1/tokens");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($cardObj));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        "Content-Type: application/json",
        "Accept: application/json",
        "Authorization: Basic " . $header
        ));

        $response = curl_exec($ch);
        curl_close($ch);

        var_dump($response);
        echo $response;
    }

    public function createChargeMagpie(){
        
        //tok_VIP0cUu1U4obvKVw4
        //generated token

        $total_amount = 2300;
        $products = "Black Shirt 2 - 1 pcs. - 600

        Black Shirt 1 - 2 pcs. - 1000
        
        Black Shirt 3 - 1 pcs. - 700";

        
        $header = base64_encode('sk_test_uanH3h8R39X3Uoi9KODBlw'. ':');

        $chargeObj = array(
            "amount" => $total_amount,
            "currency"=> "php",
            "source"=> "tok_VIP0cUu1U4obvKVw4",
            "description\""=> $products,
            "statement_descriptor"=> "ShopHere",
            "capture"=> true
        );


        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.magpie.im/v1/charges");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($chargeObj));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        "Content-Type: application/json",
        "Accept: application/json",
        "Authorization: Basic " . $header
        ));

        $response = curl_exec($ch);
        curl_close($ch);

        var_dump($response);
        echo $response;


    }

}
