<?php

namespace App\Http\Middleware\Index;

use Closure;

class CheckLoginSession
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
        //判断是否存在session
        if($request->session()->has('username')){

            return $next($request);
        }
       return redirect(url('/assistant/login'));
       // return $next($request);
    }
}
