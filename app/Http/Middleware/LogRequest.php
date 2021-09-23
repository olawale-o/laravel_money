<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class LogRequest
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
        if(App::environment() === 'local') {
            Log::debug($request);
        }
        
        return $next($request);
    }
}
