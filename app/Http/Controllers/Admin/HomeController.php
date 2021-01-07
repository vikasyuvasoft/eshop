<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use App\Models\Admin;
use App\Models\ContactUs;
use App\Models\Subscribe;
use App\Models\SubCategory;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Order;
use App\Models\User;
use Illuminate\Pagination\Paginator;

use Illuminate\Support\Facades\File;
use Illuminate\Filesystem\Filesystem;
use PDF;


use App\Http\Requests;
use Mail;
use App\Mail\CompanyVerificationEmails;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;

// use File;
class HomeController extends Controller
{
   	public function dashboard(){
   		$AuthId = Session::get('id');
      $totalProduct = Product::count();
      $totalUser = User::count();
      $totalOrder = Order::count();
      $totalContactUs = ContactUs::count();
      // echo $totalUser; die;
   		return view('admin/dashboard',compact(['totalProduct','totalUser','totalOrder','totalContactUs']));
   	}

      public function contactus()
      {
         $contactus = ContactUs::get(); //echo $contactus; die;
         $subscribe="";
         return view('admin/contactus',compact(['contactus','subscribe']));
      }

      public function subscribe(){
        $contactus="";
        $subscribe = Subscribe::all();
        return view('admin/subscribe',compact(['subscribe','contactus']));
      }

      public function deleteContactId(Request $request)
      {
       $id=$request->id;
        $status = ContactUs::where('id',$id)->delete();
        if($status)
        {
          $subscribe="";
            $contactus = ContactUs::all();
            $html =  view('admin.include.contactus',compact('contactus','subscribe'))->render();
            return response()->json(['message'=>'Data Deleted Successfully','html'=>$html]);
        }
      }

       public function deleteSubcribeId($id)
      { 
       $id=$id;
        $status = Subscribe::where('id',$id)->delete();
        if($status)
        {
         return redirect()->back()->with(['message'=>'Data Deleted Successfully']);
        }
      }

       public function category(Request $request){
        $category = Category::with('subcategory')->get();

        // echo $category; die;
        if($request->ajax())
        {
           $Validator = validator::make($request->all(),[
          'category'=>'required'
        ]);
        if($Validator->fails())
          {
            return response()->json(['errors'=>$Validator->errors()->all()]);
          }
          $categoryObj = new Category;
          $categoryObj->name = $request->category;
          $status = $categoryObj->save();
            $category = Category::with('subcategory')->get();
          $html=view('admin.include.category',compact('category'))->render();
          return response()->json(['success'=>'Category Added Successfully','html'=>$html]);
        }

        return view('admin.category',compact('category'));
      }


      public function editCategory(Request $request)
      {
          $categoryId = $request->categoryId;
         $category = Category::where('id',$categoryId)->first();
         return response()->json(['category'=>$category]);
      }


      public function updateCategory(Request $request)
      {
        $validator = validator::make($request->all(),[
          'category'=> 'required',
        ]);
        if($validator->fails())
        {
          return response()->json(['errors'=>$validator->errors()->all()]);
        }

        $category = Category::find($request->categoryId);
        $category->name = $request->category;
        $status = $category->save();
       $category = Category::with('subcategory')->get();
        $html=view('admin.include.category',compact('category'))->render();
        return response()->json(['message'=>'Category Updated Successfully','html'=>$html]);
      }

     public function deleteCategory(Request $request)
     {
       $categoryId = $request->categoryId;
    
      $status = Category::where('id',$categoryId)->delete();

        $category = Category::with('subcategory')->get();
        $html=view('admin.include.category',compact('category'))->render();
      return response()->json(['success'=>'Category Deleted Successfully','html'=>$html]);
     }

      public function subcategory(){
        $subcategory = SubCategory::with('category')->get();
        // echo $subcategory; die;
          $category = Category::with('subcategory')->get();
        return view('admin.subcategory',compact(['subcategory','category']));
      }


      public function addSubCategory(Request $request)
      {
          $validator = validator::make($request->all(),[
              'subCategoryName'=>'required',
              'mainCategoryName'=>'required',
          ]);
          if($validator->fails())
          {
            return response()->json(['errors'=>$validator->errors()->all()]);
          }
          $subCategory = new SubCategory;
          $subCategory->name = $request->subCategoryName;
          $subCategory->cat_id = $request->mainCategoryName;
          $status = $subCategory->save();
          $subcategory = SubCategory::with('category')->get();
          $html = view('admin.include.subcategory',compact('subcategory'))->render();
          return response()->json(['message'=>'SubCategory Added Successfully','html'=>$html]);


      }

      public function editSubCategory(Request $request)
      {
        $subCategoryId = $request->subCategoryId;
        $subCategory = SubCategory::with('category')->where('id',$subCategoryId)->first();
        // return $subCategory; die;
        return response()->json(['subCategory'=>$subCategory]);
      }


      public function updateSubCategory(Request $request)
      {
         // print_r($request->all()); die;
        $validate = validator::make($request->all(),[
            'SubCategoryName' =>'required',
            'mainCategoryName'=>'required',
        ]);
        if($validate->fails())
        {
          return response()->json(['errors'=>$validate->errors()->all()]);
        }

        $subCategory = SubCategory::where('id',$request->subCategoryId)->first();
        $subCategory->name = $request->SubCategoryName;
        $subCategory->cat_id = $request->mainCategoryName;
        $status = $subCategory->save();
        $subcategory = SubCategory::with('category')->get();
        $html = view('admin.include.subcategory',compact('subcategory'))->render();
        return response()->json(['message'=>'SubCategory Updated Successfully','html'=>$html]);


      }


      public function deleteSubCategory(Request $request)
      {
        $subCategoryId = $request->subCategoryId;
        $status = SubCategory::where('id',$subCategoryId)->delete();
        $subcategory = SubCategory::with('category')->get();
        $html = view('admin.include.subcategory',compact('subcategory'))->render();
        return response()->json(['message'=>'SubCategory Deleted Successfully','html'=>$html]);
      }




       public function product(){
        $product = Product::with('category','subcategory')->get();
       $subcategory = SubCategory::with('category')->get();
       // return $product;  die;
        return view('admin.product',compact(['product','subcategory']));
      }


      public function addProduct(Request $request)
      {

        $validator = validator::make($request->all(),[
          'productName'=>'required',
          'productTitle'=>'required',
          'productDescription'=>'required',
          'productPrice'=>'required',
          'productSubcategory'=>'required',
          'productMainImages'=>'required',
          'productImage'=>'required'
        ]);

        if($validator->fails())
        {
          return response()->json(['errors'=>$validator->errors()->all()]);
        }

        $productObj = new Product();
        $productObj->name = $request->productName;
        $productObj->title = $request->productTitle;
        $productObj->description = $request->productDescription;
        $productObj->price = $request->productPrice;
        $productObj->sub_cat_id = $request->productSubcategory;

        $productMainImages = $request->productMainImages;
      // echo public_path(); die;
       
        $NewProductMainImages = time(). '0.' . $productMainImages->extension();

        $uploadImage = $productMainImages->move('public/uploads',$NewProductMainImages);


         
         // echo $fileName1; die;
        $productObj->image = $NewProductMainImages;

        $status = $productObj->save();
          $i=0;
         foreach ($request->productImage as $key => $value) 
        {
          $i++;
          $fileName = time(). $i . '.' . $value->extension();
          $file = $value->move('public/uploads/', $fileName);//product/'. $fileName);
          $productImage = new ProductImage();
          $productImage->product_id = $productObj->id;
          $productImage->image = $fileName;
          $status = $productImage->save();
        }

         if($request->notification !=null){
            $subscribeUsers = Subscribe::all();
            // dd($subscribeUsers);
            if($subscribeUsers)
            {
              $details = [
              'title' => 'New Product Launch',
              'body' => 'This Product'
                ];

                 foreach($subscribeUsers as $user)
                 {

                    \Mail::to($user->email)->send(new \App\Mail\MyTestMail($details));
                    
                 }
            }

           }


        $product = Product::all();
        $html = view('admin.include.product',compact('product'))->render();
        return response()->json(['html'=>$html,'message'=>'New Product Added Successfully']);
      }

      public function editProduct(Request $request)
      {
        $productData = Product::with('productImage')->where('id',$request->productId)->first();

       
         // print_r($productData); die;
        return response()->json(['productData'=>$productData ]);
      }


      public function removeImage(Request $request)
      {
        $imgId = $request->imgId;
        $productId = $request->productId;
    //    echo url('/public/uploads/'); die;
        $productImagefile = ProductImage::where('id',$imgId)->first();
          $status = ProductImage::where('id',$imgId)->delete();

           $imagePath = public_path('uploads/'.$productImagefile->image);
           // echo $imagePath; die;
          // if(File::exists($imagePath)) {
            if (file_exists($imagePath)) {
           // echo 'yes'; die;
             // File::delete($imagePath);
              unlink($imagePath);
           
              
   
  }
         $productData = Product::with('productImage')->where('id',$productId)->first();

      
        if($status)
        {

          return response()->json(['status'=>'yes','productData'=>$productData ]);
        }
      }


      public function updateProduct(Request $request)
      {
       $validator = validator::make($request->all(),[
          'productName'=>'required',
          'productTitle'=>'required',
          'productDescription'=>'required',
          'productPrice'=>'required',
          'productSubcategory'=>'required',
          // 'productImage'=>'required'
        ]);
       // echo $request->productSubcategory; die;
        if($validator->fails())
        {
          return response()->json(['errors'=>$validator->errors()->all()]);
        }

        $productObj = Product::where('id',$request->productId)->first();
        $productObj->name = $request->productName;
        $productObj->title = $request->productTitle;
        $productObj->description = $request->productDescription;
        $productObj->price = $request->productPrice;
        $productObj->sub_cat_id = $request->productSubcategory;
        if($request->productMainImages){
        $proImage = time().'0.'.$request->productMainImages->extension();
        $request->productMainImages->move('public/uploads',$proImage);
         $productObj->image = $proImage;
      }
       
         $status = $productObj->save();

        if(!empty($request->productImage)){
            $i=0;
          foreach ($request->productImage as $value) {
            $i++;
           $newImageName = time(). $i .'.'. $value->extension();
           $saveImage = $value->move('public/uploads',$newImageName);

             $productImage = new ProductImage();
          $productImage->product_id = $request->productId;
          $productImage->image = $newImageName;
          $status = $productImage->save();
          }
        }
 
          $product = Product::all();
        $html = view('admin.include.product',compact('product'))->render();
        return response()->json(['html'=>$html,'message'=>' Product Updated Successfully']);
      }


        public function deleteProduct(Request $request)
      {
        $productId = $request->productId;
        $productData = Product::where('id',$productId)->first();
        $status = $productData->delete();

        $productImage = ProductImage::where('product_id',$productId)->get();
        // echo "<pre>"; print_r($productImage); die;
        foreach($productImage as $image){
        $status2 = productImage::where('id',$image->id)->delete();
          }

         $destinationPath = 'uploads/admin/product/';
        File::delete($destinationPath.$productData->image);


        // unlink(public_path('uploads/admin/product/'. $productData->image));

        $product = Product::all();
        $html = view('admin.include.product',compact('product'))->render();
        return response()->json(['message'=>'Product Deleted Successfully','html'=>$html]);
      }


      public function transaction(){
          $orders = Order::orderBy('id', 'DESC')->paginate(10);
          return view('admin.transaction',compact('orders'));
          }

      public function downloadOrder(Request $request,$orderId )    
      {
          // $orderId =$request->orderId;
          // dd($orderId);

          $userOrder = Order::where('id',$orderId)->first();
          $title="Welcome to eshop website";
          $userOrder->title = $title;
// dd($userOrder);
            // return view('file.admin.order')->with(['userOrder'=>$userOrder]);
           view()->share('userOrder',$userOrder);

           if($orderId){
            $pdf = PDF::loadView('file.admin.order');
          // print_r($pdf);  die;
            return $pdf->download('pdfview.pdf');

            // $pdf = PDF::loadView('pdf/personalpdf', compact('user','result'));
                // return $pdf->stream('invoice.pdf/personalpdf');
        }



      }

      public function transactionUserDetail(Request $request)    
      {
          $orderId = $request->orderId;
         $order = Order::where('id',$orderId)->first();
         return response()->json(['order'=>$order]);
      }

        public function transactionProductDetail(Request $request)    
      {
          $orderId = $request->orderId;
         $order = Order::where('id',$orderId)->first();
         // echo $order->product_detail; die;
         $productDetail = unserialize($order->product_detail);

         return response()->json(['productDetail'=>$productDetail]);
      }

      

      public function deleteOrder(Request $request)
      {
        $orderId = $request->orderId;
        $id = Order::where('id',$orderId)->delete();
        $orders = Order::orderBy('id', 'DESC')->paginate(10);
        $html = view('admin.include.transaction',compact('orders'))->render();
        // echo "<pre>"; print_r($html);
        return response()->json(['message'=>'Order Deleted Successfully','html'=>$html]);
      }


      public function users()
      {
        $users = User::all();
        return view('admin.users',compact('users'));
      }

      public function editUserStatus(Request $request)
      {
        $userId =  $request->userId;
        $status =  $request->status;
// echo $request->status; die;
        $user = User::where('id',$userId)->first();
        $user->status = $status;
        $user->save();

        $users = User::all();
        if($status==0)
        {
          $message = '1';
        }else
        {
           $message = '0';
        }

        $html = view('admin.include.users',compact('users'))->render();
        return response()->json(['message'=>$message,'html'=>$html]);

      }


   	public function logout()
   	{
   		 Session::forget('AdminloggedIn');
   		 return redirect('adminlogin')->with(['result'=>'alert-success','message'=>'Logout Successfully']);

   	}


    public function text(Request $request)
    {
      print_r($request->input());
    }

    public function upload(Request $request)
{
    if($request->hasFile('upload')) {
        //get filename with extension
        $filenamewithextension = $request->file('upload')->getClientOriginalName();
   
        //get filename without extension
        $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
   
        //get file extension
        $extension = $request->file('upload')->getClientOriginalExtension();
   
        //filename to store
        $filenametostore = $filename.'_'.time().'.'.$extension;
   
        //Upload File
        $request->file('upload')->storeAs('public/uploads', $filenametostore);
 
        $CKEditorFuncNum = $request->input('CKEditorFuncNum');
        $url = asset('storage/uploads/'.$filenametostore); 
        $msg = 'Image successfully uploaded'; 
        $re = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";
          
        // Render HTML output 
        @header('Content-type: text/html; charset=utf-8'); 
        echo $re;
    }
}
}
