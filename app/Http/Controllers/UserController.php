<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\ContactUs;
use App\Models\Subscribe;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Product;
use App\Models\User;
use Session;
use Cart;
use App\Models\Order;
use srmklive\paypal\src\Services\ExpressCheckout;
// use Srmklive\PayPal\Facades\PayPal;



class UserController extends Controller
{

    

	public function profile(){
		$userId = Session::get('id');
		$userDetail = User::where('id',$userId)->first();
		return view('website.user.profile',compact('userDetail'));
	}




	public function checkout(){      
		$userId = Session::get('id');
		$userDetail = User::where('id',$userId)->first();
	$cartItems=  Cart::content();
    Session::put('cartItems',$cartItems);
		return view('website.user.checkout',compact(['cartItems','userDetail']));
	}


    public function payment(Request $request)
    {
        // print_r($request->all()); die;
        $Validator = validator::make($request->all(),[
            'userId'=>'required',
            'name'=>'required',
            'email'=>'required',
            'phone'=>'required',
            'mobile'=>'required',
            'address'=>'required',
            'pincode'=>'required',
            'state'=>'required',
            'country'=>'required',
            'paymentType'=>'required',

        ]);

         if($Validator->fails())
        {

            return response()->json(['errors'=>$Validator->errors()->all()]);
        }

         $userId = $request->userId;
                    $name = $request->name;
                    $email =  $request->email;
                    $phone =  $request->phone;
                    $mobile =  $request->mobile;
                    $address = $request->address;
                    $pincode =  $request->pincode;
                    $state =  $request->state;
                    $country = $request->country;
                    $paymentType = $request->paymentType;
                  
                    $tax = Cart::tax(); 
                    $subtotal = Cart::subtotal();
                     $grandtotal =Cart::total();
                   
                    $cart = Cart::content();
                 // print_r($cart); die;
                    foreach ($cart as $cartData) {
                        $product['id']=$cartData->id;
                        $product['name']=$cartData->name;
                        $product['qty']=$cartData->qty;
                        $product['price']=$cartData->price;
                        $product['product_image']=$cartData->options->product_image;

                        $products[]=$product;

                        $productId[] = $cartData->id;
                    }
                      

                    $productDetail= serialize($products);
                   
        if($request->paymentType== 'cod')
        {
                    if(!empty($productId)){
                    $products = implode(',', $productId);
                   

                    $order = new Order;
                    $order->txn_id = rand(10000000000,99999999999);   
                    $order->payment_type = $paymentType;
                    $order->subtotal = $subtotal;
                    $order->tax = $tax;
                    $order->grandtotal = $grandtotal;
                    $order->name = $name;
                    $order->email = $email;
                    $order->phone = $phone;
                    $order->mobile = $mobile;
                    $order->address = $address;
                    $order->pincode = $pincode;
                    $order->state = $state;
                    $order->country = $country;
                    $order->user_id = $userId;
                    $order->product_id = $products;
                    $order->product_detail = $productDetail;
                    $status = $order->save();
                    session::put('txn_id',$order->txn_id); 
                    session::put('subtotal',$order->subtotal); 
                    session::put('tax',$order->tax); 
                    session::put('grandtotal',$order->grandtotal); 

        }

            session::put('orderId',$order->id);
            $orderDetail = Order::where('id',$order->id)->get();
           $html = view('website.user.order',compact('orderDetail'))->render();
               Cart::destroy();
             return response()->json(['message'=>'Your Product Item Confirm Ordered','paymentType'=>$paymentType,'html'=>$html]);
        }
        else if($request->paymentType=='paypal')
        {
              if(!empty($productId)){
                    $products = implode(',', $productId);
 
            Session::put(['name'=>$name,'email'=>$email,'paymentType'=>$paymentType,'phone'=>$phone,'mobile'=>$mobile,'address'=>$address,'pincode'=>$pincode,'state'=>$state,'country'=>$country,'user_id'=>$userId,'products'=>$products,'productDetail'=>$productDetail,'subtotal'=>$subtotal,'tax'=>$tax,'grandtotal'=>$grandtotal,'user']);
            return response()->json(['paymentType'=>$paymentType]);
        }

    }

           else if($request->paymentType=='stripe')
        {
              if(!empty($productId)){
                    $products = implode(',', $productId);
            Session::put(['name'=>$name,'email'=>$email,'paymentType'=>$paymentType,'phone'=>$phone,'mobile'=>$mobile,'address'=>$address,'pincode'=>$pincode,'state'=>$state,'country'=>$country,'user_id'=>$userId,'products'=>$products,'productDetail'=>$productDetail,'subtotal'=>$subtotal,'tax'=>$tax,'grandtotal'=>$grandtotal,'user']);
            return response()->json(['paymentType'=>$paymentType]);
        }

        }

    }

   public function logout(Request $request){

   Session::forget('WebsiteUserloggedIn');
   return redirect('/')->with('message','Logout Successfully');
   }

 
}
