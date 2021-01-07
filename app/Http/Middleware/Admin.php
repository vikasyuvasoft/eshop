<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Session;

class Admin
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
        $AuthId = Session::get('AdminloggedIn');
        if(empty($AuthId)){
            return redirect('adminlogin')->with('error','Please Login First');
        }
        return $next($request);
    }
}
