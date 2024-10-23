<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminAuth
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


            if (auth()->check()) {
                 
                 if (auth()->user()->tipo_usuario == 1) {
               
                  return $next($request);
                } 
                else if(auth()->user()->tipo_usuario == 2) {
                   return redirect()->to('/index_user');
               }
                
            }
            return redirect()->to('/login');
       
    }
}
