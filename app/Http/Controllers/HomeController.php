<?php

namespace App\Http\Controllers\Webiste;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;

class HomeController extends Controller
{

	public function home(){
		$category = Category::get();
	
		return view('Website.home',compact('category'));
	}

   public function contact(){
   	return view('website.contact');
   }
}
