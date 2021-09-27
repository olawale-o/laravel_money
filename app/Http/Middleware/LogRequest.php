<?php

namespace App\Http\Middleware;

use Closure;
use Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;


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
