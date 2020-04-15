<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TwoFactor
{
    /**
     * Check if the user has completed two factor auth
     * @param $request
     * @param Closure $next
     * @param null $guard
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            return redirect()->route('auth');
        }

        if (true === $request->session()->get('tfa')) {
            return $next($request);
        }

        return redirect()->route('tfa');
    }
}
