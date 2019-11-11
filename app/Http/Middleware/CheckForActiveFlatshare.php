<?php

namespace App\Http\Middleware;

use Closure;

class CheckForActiveFlatshare
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
        if (!$request->user()->hasActiveFlatshare()) {
            return redirect(route('flatsharechoiceoptions'));
        }
        return $next($request);
    }
}
