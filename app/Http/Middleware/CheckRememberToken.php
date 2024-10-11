<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRememberToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check() && $request->cookie(Auth::getRecallerName())) {
            $recaller = $request->cookie(Auth::getRecallerName());
            $userProvider = Auth::getProvider();
            $user = $userProvider->retrieveByToken(explode('|', $recaller)[0], explode('|', $recaller)[1]);

            if ($user) {
                Auth::login($user);
            }
        }

        return $next($request);
    }
}
