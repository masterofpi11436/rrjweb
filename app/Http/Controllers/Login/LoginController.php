<?php

namespace App\Http\Controllers\Login;

use Illuminate\Http\Request;

// Base Controller
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    // Show login form
    public function showLoginForm($app)
    {
        $view = "auth.{$app}-login";
        return view($view);
    }

    // Handle login
    public function login($app, Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Redirect based on application
            return $this->redirectAfterLogin($app);
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    // Redirect after login
    protected function redirectAfterLogin($app)
    {
        switch ($app) {
            case 'admin':
                return redirect()->route('admin.dashboard');
            case 'phone':
                return redirect()->route('phone.dashboard');
            case 'tablet':
                return redirect()->route('tablet.dashboard');
            default:
                return redirect('/');
        }
    }

    // Handle logout
    public function logout($app)
    {
        Auth::logout();
        return redirect("/{$app}/login");
    }
}
