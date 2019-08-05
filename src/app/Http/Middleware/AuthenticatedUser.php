<?php

namespace App\Http\Middleware;

use Closure;

class AuthenticatedUser
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
        $authorization = $request->header('Authorization');

        abort_unless($authorization == 'QpwL5tke4Pnpja7X4', 401, 'Invalid Token Specified.');

        return $next($request);
    }
}
