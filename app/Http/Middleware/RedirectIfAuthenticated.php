<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        switch ($guard) {
            case 'admin':
                if (Auth::guard($guard)->check())
                {
                    return redirect('admin/admin_dashboard')->with('status',"Login successfully");
                }
                break;
            default: //in  case off admin
                if (Auth::guard($guard)->check())
                {
                    return redirect()->back()->with('status_err',"Username & password not matched");
                }
                break;
        }

        return $next($request);
    }
}
