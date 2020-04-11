<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class PelangganOnly
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
        
        if(Auth::guard('pelanggan')->user()){
            return $next($request);
        } else {
            return redirect()->route('masuk');
        }
    }
}
