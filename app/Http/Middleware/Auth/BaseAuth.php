<?php

namespace App\Http\Middleware\Auth;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

abstract class BaseAuth
{
    // Logout Timer
    protected $sessionLifetime = 3600;

    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        // Check if user is authorized for the application
        if (!$this->hasAccess($user)) {
            return redirect()->route($this->getRedirectRoute())->withErrors(['access_denied' => $this->getAccessDeniedMessage()]);
        }

        // Check if the session has expired, redirect to login page of that application if it has
        $sessionStart = $request->session()->get('login_session');
        if ($sessionStart && (time() - $sessionStart > $this->sessionLifetime)) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route($this->getRedirectRoute())->withErrors(['session_timeout' => 'Your session has expired. Please log in again.']);
        }

        // Update session time to extend the session
        $request->session()->put('login_session', time());

        return $next($request);
    }

    abstract protected function hasAccess($user): bool;

    abstract protected function getRedirectRoute(): string;

    abstract protected function getAccessDeniedMessage(): string;
}
