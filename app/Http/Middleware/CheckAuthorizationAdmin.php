<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckAuthorizationAdmin
{
    public function handle(Request $request, Closure $next, $role): Response
    {
        $user = Auth::user();

        // Check if the user is authenticated and has the necessary role
        if (!$user || ($user->admin !== 1 && $user->admin !== 1)) {
            // Redirect to a different page if access is denied
            return redirect()->route('admin.login')->withErrors(['access_denied' => 'You do not have access to this page.']);
        }

        return $next($request); // Allow access if the check passes
    }
}
