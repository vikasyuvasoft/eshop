<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\WebsiteController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PayPalController;
use App\Http\Controllers\StripePaymentController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('website.home');
// });






Route::get('/',[WebsiteController::class,'home'])->name('home');

Route::post('/save_fcm_token', [WebsiteController::class,'save_fcm_token'])->name('user.save_fcm_token');


Route::get('/priceRange',[WebsiteController::class,'priceRange'])->name('priceRange');

Route::get('searchProduct',[WebsiteController::class,'searchProduct'])->name('searchProduct');
Route::get('ViewProduct',[WebsiteController::class,'viewproduct'])->name('ViewProduct');
Route::get('addtocart',[WebsiteController::class,'addtocart'])->name('addtocart');
Route::get('cart',[WebsiteController::class,'cart'])->name('cart');
// Route::get('showcart',[WebsiteController::class,'showcart'])->name('showcart');
Route::get('removeCartItem',[WebsiteController::class,'removeCartItem'])->name('removeCartItem');
Route::get('addQty',[WebsiteController::class,'addQty'])->name('addQty');
Route::get('minusQty',[WebsiteController::class,'minusQty'])->name('minusQty');
Route::view('/shop','website.shop');
Route::view('/contact','website.contact');
// Route::view('/cart','website.cart');
Route::view('/login','website.login');
Route::post('SubmitContact',[WebsiteController::class,'SubmitContact'])->name('SubmitContact');
Route::post('subscribe',[WebsiteController::class,'subscribe'])->name('subscribe');

Route::post('registration',[WebsiteController::class,'registration'])->name('registration');
Route::post('loginUser',[WebsiteController::class,'loginUser'])->name('loginUser');
Route::get('thankyou',[WebsiteController::class,'success'])->name('user.thankyouPaypal');


Route::group(['prefix'=>'user','middleware'=>['user','checkout']],function(){
Route::get('profile',[UserController::class,'profile'])->name('user.profile');
Route::get('checkout',[UserController::class,'checkout'])->name('user.checkout');

Route::post('payment',[UserController::class,'payment'])->name('user.payment');

// route for processing payment
Route::post('paypal', [PayPalController::class,'payWithpaypal']);
 
// route for check status of the payment
Route::get('status', [PayPalController::class,'getPaymentStatus']);
Route::post('stripe', [StripePaymentController::class,'stripePost'])->name('user.stripe.post');
 Route::get('logoutUser',[UserController::class,'logout'])->name('user.logout');

});

Route::view('/adminlogin','admin.login');

Route::post('SubmitLoginData',[LoginController::class,'SubmitLoginData'])->name('SubmitLoginData');

Route::group(['prefix'=>'admin','middleware'=>['admin']],function(){

Route::get('dashboard',[HomeController::class,'dashboard'])->name('dashboard');
Route::get('contactus',[HomeController::class,'contactus'])->name('contactus');
Route::get('subscribe',[HomeController::class,'subscribe'])->name('subscribe');

Route::match(['get','post'],'category',[HomeController::class,'category'])->name('category');
Route::get('editCategory',[HomeController::class,'editCategory'])->name('editCategory');
Route::post('updateCategory',[HomeController::class,'updateCategory'])->name('updateCategory');
Route::get('deleteCategory',[HomeController::class,'deleteCategory'])->name('deleteCategory');


Route::get('subcategory',[HomeController::class,'subcategory'])->name('subcategory');
Route::post('addSubCategory',[HomeController::class,'addSubCategory'])->name('addSubCategory');
Route::get('editSubCategory',[HomeController::class,'editSubCategory'])->name('editSubCategory');
Route::post('updateSubCategory',[HomeController::class,'updateSubCategory'])->name('updateSubCategory');
Route::get('deleteSubCategory',[HomeController::class,'deleteSubCategory'])->name('deleteSubCategory');

Route::get('product',[HomeController::class,'product'])->name('product');
Route::post('addProduct',[HomeController::class,'addProduct'])->name('addProduct');
Route::get('editProduct',[HomeController::class,'editProduct'])->name('editProduct');
Route::post('product/removeImage',[HomeController::class,'removeImage'])->name('product.removeImage');
Route::post('updateProduct',[HomeController::class,'updateProduct'])->name('updateProduct');
Route::get('deleteProduct',[HomeController::class,'deleteProduct'])->name('deleteProduct');

Route::get('transaction',[HomeController::class,'transaction'])->name('transaction');

// Route::get('downloadOrder',[HomeController::class,'downloadOrder'])->name('downloadOrder');
Route::get('downloadOrder/{orderId}',[HomeController::class,'downloadOrder'])->name('downloadOrder');

Route::post('transactionProductDetail',[HomeController::class,'transactionProductDetail'])->name('transactionProductDetail');

Route::post('transactionUserDetail',[HomeController::class,'transactionUserDetail'])->name('transactionUserDetail');

Route::get('deleteOrder',[HomeController::class,'deleteOrder'])->name('deleteOrder');

Route::post('deleteContactId',[HomeController::class,'deleteContactId'])->name('deleteContactId');
Route::get('deleteSubscribeId/{id}',[HomeController::class,'deleteSubcribeId'])->name('deleteSubcribeId');
Route::get('users',[HomeController::class,'users'])->name('users');
Route::get('editUserStatus',[HomeController::class,'editUserStatus'])->name('editUserStatus');

Route::get('text',[HomeController::class,'text'])->name('ckeditor');
Route::post('ckeditor/image_upload', 'HomeController@upload')->name('upload');

Route::get('logout',[HomeController::class,'logout'])->name('logout');

});
