<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class PreventBackHistory
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
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
        header('Content-Type: text/html');
        header("Pragma: no-cache");

        return $next($request);
    }
}
