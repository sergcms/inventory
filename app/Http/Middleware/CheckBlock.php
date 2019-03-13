<?php

namespace App\Http\Middleware;

use Closure;

class CheckBlock
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
        if (auth()->user()->isblock === 1) {
            Auth::logout();
            
            return response()->view('isblock');
        }
        
        return $next($request);
    }
}