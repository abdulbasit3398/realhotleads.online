<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class AdminStaffAccess
{
    
    public function handle($request, Closure $next)
    {
        if(Auth::user()->type == 'admin' || Auth::user()->type == 'staff')
        {
            return $next($request);
        }
        else
        {
            Auth::logout();
            return redirect(route('login'));
        }
        
    }
}
