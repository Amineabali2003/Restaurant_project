<?php

namespace App\Http\Middleware;
// use Auth;
use Illuminate\Support\Facades\Auth;

use Closure;
use Illuminate\Http\Request;

class user
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        if (!Auth::check()) {
            return redirect()->route('login');
        }
       else if(Auth::user()->usertype == 0){
            return $next($request);

        }
        else{
            return redirect('/');

        }

    }
}
