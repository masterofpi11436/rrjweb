<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Login\Application;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;


class UserAuthorization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $requiredRole
     * @return mixed
     */
    public function handle($request, Closure $next, $requiredRole)
    {
        // Check if user is authenticated
        if (!Auth::check()) {
            return redirect('/login');
        }

        // Get the authenticated user
        $user = Auth::user();
        $route = $request->path(); // Get the requested route

        // Get the current application, you can get this from the route or request
        $application = Application::where('name', $request->application_name)->first();

        if ($application && $this->hasRoleForApplication($user, $application, $requiredRole)) {
            // If user has the required role, proceed with the request
            return $next($request);
        }

        // Redirect to login or unauthorized page if access is denied
        return redirect('/login')->withErrors('Unauthorized access.');
    }

    /**
     * Check if the user has the required role for the application.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Application $application
     * @param string $requiredRole
     * @return bool
     */
    private function hasRoleForApplication($user, $application, $requiredRole)
    {
        // Check if the user has the required role for the given application
        return $user->roles()
                    ->where('application_id', $application->id)
                    ->where('name', $requiredRole)
                    ->exists();
    }
}
