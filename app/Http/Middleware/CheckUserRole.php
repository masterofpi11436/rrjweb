<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, ...$roles)
    {
        $user = Auth::user(); // Get the logged-in user

        // Get the current role of the user in the application
        $applicationRoleId = $user->applications()->first()->pivot->role_id;

        // Check if the user's role matches one of the allowed roles
        if (!in_array($applicationRoleId, $roles)) {
            return redirect('/no-access')->with('error', 'You do not have the required role.');
        }

        // If the user's role matches, proceed with the request
        return $next($request);
    }
}
