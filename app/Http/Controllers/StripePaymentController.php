<?php

namespace App\Http\Controllers;
use Session;
use Stripe;
use App\Models\Order;
use Illuminate\Http\Request;
use Cart;

class StripePaymentController extends Controller
{
        public function stripePost(Request $request)
    {
       // echo round(Cart::total()); die;
       // print_r($_POST); die();
// print_r($request->input()); die;
        Stripe\Stripe::setApiKey('sk_test_51HopbhAI9PSb8k45GREbwyPKsJUZ3Fz2w5ZvilCqZouSwhFN9IfMIxkjtA4teO3hu4PX7COb0rivm19LC9rienBk00W8G3KMTV');
            // print_r($request->input()); die;
       $response =  Stripe\Charge::create ([
                "amount" => round(Cart::total()),
                "currency" => "inr",
                "source" => $request->stripeToken,
                "description" => "Test payment from itsolutionstuff.com." 
        ]);
        echo "<pre>";
  // print_r($response->source->id); die;
  		  $order = new Order();
 		$order->txn_id = $response->source->id;
            $order->payment_type = Session::get('paymentType');

            $order->subtotal = Session::get('subtotal');
            $order->tax = Session::get('tax');
            $order->grandtotal = Session::get('grandtotal');
            $order->name = Session::get('name');
            $order->email = Session::get('email');
            $order->phone = Session::get('phone');
            $order->mobile =Session::get('mobile');
            $order->address = Session::get('address');
            $order->pincode = Session::get('pincode');
            $order->state = Session::get('state');
            $order->country = Session::get('country');
            $order->user_id = Session::get('user_id');
            $order->product_id = Session::get('products');
            $order->product_detail = Session::get('productDetail');
            $status = $order->save();

            if($status==1)
            {
            	  Cart::destroy();
            \Session::put('success_paypal', 'Payment success');
            \Session::put('orderId', $order->id);
             return Redirect('thankyou')->with('success_paypal','Payment success');
            }
            else
            {
            	\Session::put('error_paypal', 'Payment failed');
         Cart::destroy();
        return Redirect('thankyou')->with('error_paypal','Payment failed');
            }

        
          
       
    }
}
