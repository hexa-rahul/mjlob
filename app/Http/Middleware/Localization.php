<?php

namespace App\Http\Middleware;

use Closure;

class Localization
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
        $appkey = ($request->hasHeader('api-key')) ? $request->header('api-key'):''; 
        if(!empty($appkey)){
          if($appkey=='#%2$#12fd$%^fg5'){
            $version = ($request->hasHeader('version')) ? $request->header('version'):'1'; 
            if(!empty($version)){
                if($version=='1'){
                    return $next($request);
                }else{
                    return response()->json([
                        'status'  => 401,
                        'message' => "Invalid Version!",
                        'object'  => (object) []
                    ]);
                }

            }else{
              
                return response()->json([
                    'status'  => 401,
                    'message' => "Version is required",
                    'object'  => (object) []
                ]);
            }
            
          }else{

            return response()->json([
                'status'  => 401,
                'message' => "Invalid Api key!",
                'object'  => (object) []
            ]);

          }

        }else{
          
          return response()->json([
              'status'  => 401,
              'message' => "Api key is required",
              'object'  => (object) []
          ]);
        }

        $version = ($request->hasHeader('version')) ? $request->header('version'):''; 
        if(!empty($version)){
          if($version=='1'){

            return $next($request);
            
          }else{

            return response()->json([
                'status'  => 401,
                'message' => "This is outdated version, Please update version!",
                'object'  => (object) []
            ]);

          }

        }else{
          
          return response()->json([
              'status'  => 401,
              'message' => "Version is required",
              'object'  => (object) []
          ]);
        }

        return $next($request);
    }
}
