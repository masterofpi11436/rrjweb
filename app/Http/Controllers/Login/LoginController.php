<?php

namespace App\Http\Controllers\Login;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// Base Controller
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    // Show login form
    public function showLoginForm($app)
    {
        $view = "Login.{$app}-login";

        if (!view()->exists($view)) {
            abort(404);
        }
        return view($view);
    }

    // Handle login
    public function login($app, Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return $this->redirectAfterLogin($app);
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    // Redirect after login
    protected function redirectAfterLogin($app)
    {
            // Create a map of applications to their corresponding routes
        $routes = [
            'admin'  => 'admin.dashboard',
            'phone'  => 'phone.dashboard',
            'tablet' => 'tablet.dashboard',
        ];

        // Check if the app exists in the map and redirect to the corresponding route
        return isset($routes[$app])
            ? redirect()->route($routes[$app])
            : redirect('/'); // Fallback in case the app is not found
    }

    // Handle logout
    public function logout($app)
    {
        Auth::logout();
        return redirect("/{$app}/login");
    }
}
