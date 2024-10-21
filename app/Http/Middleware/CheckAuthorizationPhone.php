<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckAuthorizationPhone
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        // Check if the user is authenticated and has phone access or is an admin
        if (!$user || ($user->phone !== 1 && $user->admin !== 1)) {
            return redirect()->route('phone.login')->withErrors(['access_denied' => 'You do not have access to this page.']);
        }

        return $next($request); // Allow access if the check passes
    }
}
