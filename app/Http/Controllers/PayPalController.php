<?php
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use App\Models\Order;
use Cart;
/** All Paypal Details class **/
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;
use Redirect;
use Session;
use URL;
 
class PayPalController extends Controller
{
    private $_api_context;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
 
        /** PayPal api context **/
        $paypal_conf = \Config::get('paypal');
        // print_r($paypal_conf); die;
        $this->_api_context = new ApiContext(new OAuthTokenCredential(
            $paypal_conf['client_id'],
            $paypal_conf['secret'])
        );
        $this->_api_context->setConfig($paypal_conf['settings']);
 
    }
    
    public function payWithpaypal(Request $request)
    {
        // echo Session::get('subtotal'); die;
 // print_r($request->input()); die;
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');
 
        $item_1 = new Item();
        $item_2 = new Item();
 
        $item_1->setName('Item 1') /** item name **/
            ->setCurrency('USD')
            ->setQuantity(1)
            ->setPrice($request->get('amount')); /** unit price **/
 
     $item_2->setName('Item 2') /** item name **/
            ->setCurrency('USD')
            ->setQuantity(1)
            ->setPrice($request->get('amount'));

        $item_list = new ItemList();
        $item_list->setItems([]);
        // print_r($item_list); die;
       
 
        $amount = new Amount();
        $amount->setCurrency('USD')
            ->setTotal($request->get('amount'));
        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($item_list)
            ->setDescription('Your transaction description');
 
        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(URL::to('user/status')) /** Specify return URL **/
            ->setCancelUrl(URL::to('user/status'));
 
        $payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions(array($transaction));
  // print_r($payment); die;

        /** dd($payment->create($this->_api_context));exit; **/
        try {
 
            $payment->create($this->_api_context);
 
        } catch (\PayPal\Exception\PPConnectionException $ex) {
 
            if (\Config::get('app.debug')) {
 
                \Session::put('error', 'Connection timeout');
                return Redirect::to('/');
 
            } else {
 
                \Session::put('error', 'Some error occur, sorry for inconvenient');
                return Redirect::to('/');
 
            }
 
        }
 
        foreach ($payment->getLinks() as $link) {
 
            if ($link->getRel() == 'approval_url') {
 
                $redirect_url = $link->getHref();
                break;
 
            }
 
        }
 
        /** add payment ID to session **/
        // echo $payment->getId(); die;
        Session::put('paypal_payment_id', $payment->getId());

        if (isset($redirect_url)) {
 
            /** redirect to paypal **/
            return Redirect::away($redirect_url);
 
        }
 
        \Session::put('error', 'Unknown error occurred');
        return Redirect::to('/');
 
    }
 
    public function getPaymentStatus(Request $request)
    {
        // die('he'); 
        /** Get the payment ID before session clear **/
    // print_r($request->input()); die; 

        $payment_id = Session::get('paypal_payment_id');
        // echo $payment_id; die;
        /** clear the session payment ID **/

        // Session::forget('paypal_payment_id');

        // echo  $payment_id; die;
        if (empty($request->input('PayerID'))  || empty($request->input('token'))) {
 // echo $request->input('token'); die;
            \Session::put('error', 'Payment failed');
            return Redirect::to('/');
 
        }
 
        $payment = Payment::get($payment_id, $this->_api_context);
        $execution = new PaymentExecution();
        $execution->setPayerId($request->input('PayerID'));
 
        /**Execute the payment **/
        $result = $payment->execute($execution, $this->_api_context);
        echo "<pre>";

        // print_r($result);
        $order = new Order();
        $order->txn_id = $result->transactions[0]->related_resources[0]->sale->id;
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

        // print_r($result->transactions[0]->related_resources[0]->sale->id);
        // die;
        if ($result->getState() == 'approved') {
                 Cart::destroy();
            \Session::put('success_paypal', 'Payment success');
            \Session::put('orderId', $order->id);
            // echo session::get('orderId');
             return Redirect('thankyou')->with('success_paypal','Payment success');
 
        }
        else{
 
        \Session::put('error_paypal', 'Payment failed');
         Cart::destroy();
          \Session::put('orderId', $order->id);
        return Redirect('thankyou')->with('error_paypal','Payment failed');
    }
 
    }
 
}