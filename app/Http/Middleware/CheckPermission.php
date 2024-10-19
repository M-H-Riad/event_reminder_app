<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $permission)
    {
        if (!Auth::user()->can($permission)) {
            // Redirect or abort if the user does not have the required permission
            return redirect()->route('roles.index')->with('error', 'You do not have permission to access this resource.');
        }

        return $next($request);
    }
}
