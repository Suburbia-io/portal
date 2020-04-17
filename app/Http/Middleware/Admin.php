<?php

namespace App\Http\Middleware;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class Admin
{

    /**
     * Check if the user is an admin
     * @param $request
     * @param Closure $next
     * @param null $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (!auth()->check()) {
            return redirect()->route('auth');
        }

        /** @var User $user */
        $user = Auth::user();

        if (!$user->isAdmin()) {
            return abort(401);
        }

        return $next($request);
    }

}
