<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\ContactUs;
use App\Models\Subscribe;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\User;
use Session;
use Cart;
use App\Models\Order;
use Illuminate\Pagination\Paginator;
use DB;

class WebsiteController extends Controller
{

    public function home(Request $request){
        
        // return $category; die;
        if($request->ajax())
         {
            $subCategoryId = $request->subCategoryId;
            if($subCategoryId=='null')
            {
                 $product = Product::get();
            }
            else
            {
            $product = Product::where('sub_cat_id',$subCategoryId)->get();
        }
// return $product; die;
  $html = view('website.include.product',compact('product'))->render();
           return response()->json(['html'=>$html]);

         } 
         else{  
        $category = Category::with('subcategory')->get();
      // echo $category; die;
        $product = Product::paginate(6);
        $mainCategoryByProduct = Category::with('product')->get();
       
        // return $mainCategoryByProduct; die;
        return view('website.home',compact(['category','product','mainCategoryByProduct']));
    }
}


    public function priceRange(Request $request)
    {   
        // DB::enableQueryLog();
        $rangePrice = $request->range;
        $priceArray = explode('-',$rangePrice);
        // print_r($priceArray); die;
        $minPrice = (int)$priceArray[0];
        $maxPrice = (int)$priceArray[1];

        if($minPrice==0 && $maxPrice==0)
        {
            $product = Product::paginate(6);
        }else{
        $product = Product::whereBetween('price',[$minPrice,$maxPrice])->get();
       }
         $html = view('website.include.product',compact('product'))->render();
           return response()->json(['html'=>$html]);
       
      
    }

    public function cart(Request $request){

        if($request->ajax()){

              $cartItems = Cart::content(); 

              $html = view('website.include.cart',compact('cartItems'))->render();
              $tax = Cart::tax();
              $total = Cart::total();
              $subtotal = Cart::subtotal();


          return response()->json(['html'=>$html,'tax'=>$tax,'subtotal'=>$subtotal,'total'=>$total]);
        }


// Cart::destroy();
        $cartItems = Cart::content(); 
        // echo Cart::tax(); die;
       // print_r($cartItems); die;
        return view('website.cart',compact('cartItems'));
    }


    function searchProduct(Request $request)
    {
       $searchProduct = $request->searchProduct;
       // echo $searchProduct; die;
       if($searchProduct)
       {
       $product = Product::query()
                    ->where('name','LIKE',"%{$searchProduct}%")
                    ->orwhere('price','LIKE',"%{$searchProduct}%")
                    ->orwhere('title','LIKE',"%{$searchProduct}%")
                    ->get();
        }
        else
        {
                $product = Product::get();
        }    
        // print_r($product); die;        
           $html = view('website.include.product',compact('product'))->render();         
         return response()->json(['html'=>$html]);           
    }




    public function viewproduct(Request $request){
       $ProductId = $request->id; 
       $ProductDetail = Product::where('id',$ProductId)->first();
       $ProductImages =  ProductImage::where('product_id',$ProductId)->where('image','!=',$ProductDetail->image)->inRandomOrder()->get();
       $allProduct = Product::where('id','!=',$ProductId)->inRandomOrder()->limit(6)->get();
        // print_r($ProductImages); die;
       $ViewProductHtml = view('website.viewproduct',compact(['ProductDetail','ProductImages','allProduct']))->render();
       return response()->json(['html'=>$ViewProductHtml]);
    }

    public function addtocart(Request $request){
        $productId = $request->product_id;
        $product_image = $request->product_image;
        $productName = $request->product_name;
        $productPrice = $request->product_price;
        $productQuantity = $request->quantity;
        // print_r($request->input()); die;

       $CartItem = Cart::add($productId,$productName,$productQuantity,$productPrice,['product_image' => $product_image]);
       return response()->json(['message'=>'Product Added Successfully']);
    }

    public function removeCartItem(Request $request){
        $cartId = $request->rowId;
        $status = Cart::remove($cartId);
        return response()->json(['message'=>'Product Deleted Successfully']);
    }

    public function addQty(Request $request){
        $qty = $request->qty;
        $rowId = $request->rowId;

        $newQty = $qty+'1';

        $status = Cart::update($rowId,$newQty);
        // return Cart::get($rowId);die;
        return response()->json(['message'=>'Product Quantity Updated Successfully']);
       
    }

    public function minusQty(Request $request){
        $qty = $request->qty;
        $rowId = $request->rowId;
         if($qty==1){
                    $newQty=$qty;
                }
                else{
        $newQty = $qty-'1';
    }

        $status = Cart::update($rowId,$newQty);
        // return Cart::get($rowId);die;
        return response()->json(['message'=>'Product Quantity Updated Successfully']);

    }
    public function SubmitContact(Request $request)
    {
    	$validator = validator::make($request->all(),[
    		'name'=>'required',
    		'email'=>'required',
    		'subject'=>'required',
    		'message'=>'required',

    	]);
    	if($validator->fails()){
    		return response()->json(['error'=>$validator->errors()->all()]);
    	}
    	$contact = new ContactUs;
    	$contact->name = $request->name;
    	$contact->email = $request->email;
    	$contact->subject = $request->subject;
    	$contact->message = $request->message;
    	$status = $contact->save();
    	if($status)
    	{
    		return response()->json(['success'=>'Thank You ! We Will Contact You Hurry ']);
    	}
    }

    public function subscribe(Request $request)
    {
        $validator = validator::make($request->all(),[
            'email'=>'required',
        ]);
        if($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->all()]);
        }

        $subscribe = new Subscribe;
        $subscribe->email = $request->email;
        $status = $subscribe->save();
        if($status)
        {
            return response()->json(['message'=>'Thank You .']);
        }    

    }



public function registration(Request $request){
    $validator= Validator::make($request->all(),[

        'name'=>'required',
        'email'=>'required|email|unique:users',
        'password'=>'required',
        'mobile'=>'required',

    ]);

    if($validator->fails())
    {
        return response()->json(['error'=>$validator->errors()->all()]);
    }

    $user = new User();
    $user->name = $request->name;
    $user->email = $request->email;
    $user->mobile = $request->mobile;
    $user->password = $request->password;
    if($request->address){
         $user->address = $request->address;
    }
    $user->phone=$request->phone?$request->phone:"";
    $user->state=$request->state?$request->state:"";
    $user->country=$request->country?$request->country:"";
    $user->pincode=$request->pincode?$request->pincode:"";
    $status = $user->save();
    if($status){
        return response()->json(['message'=>'registration Successfully']);
    }
}
public function loginUser(Request $request){
    $validator = Validator::make($request->all(),[
        'email'=>'required|email',
        'password'=>'required',
    ]);
    if($validator->fails()){
        return response()->json(['error'=>$validator->errors()->all()]);
    }
    $email = $request->email;
    $password = $request->password;
    $user = User::where('email',$email)->first();
    if(empty($user))
     {
        return response()->json(['customError'=>'Your Email Id Is Not Registar Please Sign Up First']);
     }
    
    if($password != $user->password)
    {
      return response()->json(['customError'=>'Your Password Is Wrong']);
    }
     Session::put('id',$user->id);
     Session::put('WebsiteUserloggedIn','1');
    return response()->json(['success'=>'You Are Logged In']) ;
}


  public function success(){
    $orderId = session::get('orderId');
    $orderDetail=array();
    $orders = Order::where('id',$orderId)->get();
    Session::forget('orderId');
    return view('website.user.order',compact(['orders','orderDetail']));
   }


public function save_fcm_token(Request $request)
{
$errors=NULL;
$message = "Success";
$validator = Validator::make($request->all(), [
'fcm_token' => 'required',
],
[
'title.fcm_token' => 'fcm token required',
]
);
if ($validator->fails()) {
$status = false;
$errors = $validator->errors();
$message = " Error !! ";
}
$user = auth()->user()->update([
'fcm_token'=>$request->fcm_token
]);
$status = $user?true:false;
return response()->json(
[
'message'=>$message,
'status'=>$status,
'errors'=>$errors,
'fcm_token'=>$request->fcm_token
]
);
}



}
