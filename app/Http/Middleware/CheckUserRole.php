<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

// Manual imports
use Illuminate\Support\Facades\Auth;

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
    
        // Get the application the user is trying to access
        $app = $request->route('app'); // Assuming 'app' is a route parameter
    
        // Find the user's role in the specific application
        $application = $user->applications()->where('name', ucfirst($app))->first();
    
        if (!$application || !in_array($application->pivot->role_id, $roles)) {
            return redirect('/no-access')->with('error', 'You do not have the required role.');
        }
    
        return $next($request);
    }
    
}
