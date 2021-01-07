<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Session;

class User
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
      
        $user = Session::get('WebsiteUserloggedIn');

        if(empty($user)){
            return redirect('/login')->with('error','Please Login First');
        }
          return $next($request);
    }
}
