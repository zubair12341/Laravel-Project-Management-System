<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class ClientRole
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
        if (!Auth::guard('client_login')->check()) {
            return redirect('/ClientLogin');
        }

        if (Auth::guard('client_login')->check() && Auth::guard('client_login')->user()->is_client == 1) {
            return $next($request);
        }
        else{
            return redirect()->back();
        }
    }
}
