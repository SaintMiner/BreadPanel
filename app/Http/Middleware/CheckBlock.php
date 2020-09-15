<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
use Auth;

class CheckBlock
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::check()) {
            $user = Auth::user();
        } else {
            $user = User::where('username', $request->username)->first();
            $user = null;
        }
        if($user) {
            if ($user->blocked) return response('BLOCKED', 401);
        }

        return $next($request);
    }
}
