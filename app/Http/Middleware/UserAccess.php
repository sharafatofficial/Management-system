<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next,$type): Response
    {
      
    if(auth()->user()->user_type==$type)
        {
            return $next($request);
        }
        else{
            return redirect('/error');
        }
         
       
    }
}
