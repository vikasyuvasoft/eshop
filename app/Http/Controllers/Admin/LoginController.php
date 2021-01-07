<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use Session;
use App\Models\Admin;

class LoginController extends Controller
{
   
   public function SubmitLoginData(Request $request)
   {
   		$v = Validator::make($request->all(),[      
   			'email'=>'required',
   			'password'=>'required',
   		]);
   		if($v->passes())
   		{ 
	   		$email = $request->email;
	   		$password = $request->password;
	   		$admin = Admin::where('email',$email)->first();
	   		$AdminPassword = $admin->password;
	   		if(!Hash::check($password, $AdminPassword))
	   		{
             	 return redirect()->back()->with(['result'=>'alert-danger','message'=>'Wrong Password']);	
            }
            if($admin->status==0)
            {
            	return redirect()->back()->with(['result'=>'alert-danger','message'=>'Your account is not active']);
            }
            session::put('id',$admin->id);
            session::put('name',$admin->name);
            session::put('AdminloggedIn','1');
            return redirect('admin/dashboard');



       	}
       	else{
       		return redirect::back()->withErrors($v)->withInput();
       	}

   }
}
