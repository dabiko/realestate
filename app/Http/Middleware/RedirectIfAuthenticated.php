<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {

                if (Auth::check() && Auth::user()->role == 'user'){

                    return redirect(RouteServiceProvider::HOME);

                }elseif (Auth::check() && Auth::user()->role == 'agent'){

                    return redirect(RouteServiceProvider::AGENTDASHBOARD);

                }elseif (Auth::check() && Auth::user()->role == 'admin'){

                    return redirect(RouteServiceProvider::ADMINDASHBOARD);

                }

            }
        }

        return $next($request);
    }
}
