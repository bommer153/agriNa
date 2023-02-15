<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class userMiddle
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
            if(\Auth::user()->role == 2){
                if(\Auth::user()->smsverification == 0){ 
                    //\auth::logout();                    
                    return $next($request);  
                    return redirect()->route('verify'); 
                }else{             
                    return $next($request);
                }               
            }else{
                return redirect('/login');
            }
            return redirect('/login');
        }
    }
}
