<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Closure;

class CheckMultiUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,  $guard = null)
    {
        // echo 1;die();
        // echo $guard; die;
        if (Auth::guard($guard)->check()) {
            $user = Auth::user();

            // if($user->status == 0 )
            // {
            //     $output["message"] =  "Your account is deleted";
            //     $output["status"] = 400;
            //     return response()->json($output ,200);
            // }

            // if($user->isActive == 0)
            // {
            //     $output["message"] = "Your account is deactivated";
            //     $output["status"] = 400;
            //     return response()->json($output ,200);
            // }
        }

        return $next($request);
    }
}

