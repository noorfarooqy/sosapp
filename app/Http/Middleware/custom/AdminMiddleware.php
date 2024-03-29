<?php

namespace App\Http\Middleware\custom;

use Closure;

class AdminMiddleware
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
        $user = $request->user()->AdminInfo;
        if($user == null)
            abort(403);
        return $next($request);
    }
}
