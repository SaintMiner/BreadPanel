<?php

namespace App\Http\Middleware;

use Closure;

use App\ProtectedRoute;

class CheckRoute
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
        $routeName = $request->route()->getName();
        $route = ProtectedRoute::where('name', $routeName)->first();
        if ($route) {
            if (!auth()->check()) return response(['message' => 'unauthorized'], 422);

            if (!auth()->user()->can($route->getPermissionNames())) return response(['message' => 'Not enough permissions'], 422);
        }
        return $next($request);
    }
}
