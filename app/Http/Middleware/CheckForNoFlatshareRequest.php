<?php

namespace App\Http\Middleware;

use Closure;

class CheckForNoFlatshareRequest
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
        if ($request->user()->hasFlatshareRequest()) {
            return redirect(route('flatsharerequest'));
        }
        return $next($request);
    }
}
