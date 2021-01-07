<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Session;
use Cart;

class Checkout
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
      
      $total =  Cart::total(); 
      if($total==0)
      {
      	  // return redirect('/cart')->with('error','Please Login First');
      }
       
          return $next($request);
    }
}
