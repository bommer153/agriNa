<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class driverMiddle
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
        if(\Auth::check()){
            if(\Auth::user()->role == 3 ){
                if(\Auth::user()->license == 0){
                    \Auth::logout();
                    return redirect('/login')->with('driver','Go to Cityhall for Verification');
                }else{             
                    return $next($request);
                }
            }else{                
                return redirect('/dashboard');
            }
            return redirect('/login');
        }
    }
}
