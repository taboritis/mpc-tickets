<?php

namespace App\Http\Middleware;

use Closure;

class SupportMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        return ($request->user()->type === 'support_member')
            ? $next($request)
            : redirect('/tickets')
                ->withErrors([ 'Only support member can see list of notes.' ]);
    }
}
