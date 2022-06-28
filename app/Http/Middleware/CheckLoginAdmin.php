<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
class CheckLoginAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    public function handle($request, Closure $next)
    {
        if(Auth::check()){
            if(!Auth::user()->is_active){
                Auth::logout();
                return redirect()->route('admin.login')->with('msg','Tài khoản của bạn đã bị khóa !!!');
            } 
            else if(!Auth::user()->is_admin){
                Auth::logout();
                return redirect()->route('admin.login')->with('msg','Bạn không có quyền !!!');
            }
            else {
                return $next($request);
            }
        }else{
            return redirect()->route('admin.login');
        }
    }
}
