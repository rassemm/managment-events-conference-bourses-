<?php

namespace App\Http\Middleware;

use Closure;

class EventManager
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
        $request->user()->authorizeRoles('event_manager');
        return $next($request);
    }
}
