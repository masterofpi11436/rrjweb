<?php

namespace App\Http\Controllers\Login;

use App\Models\Login\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleLoginController extends Controller
{
    // Redirects to google
    public function googleLogin()
    {
        return Socialite::driver('google')->stateless()->redirect();
    }

    // Authenitcates the user through the google account
    public function googleAuthentication()
    {
        $googleUser = Socialite::driver('google')->stateless()->user();

        $user = User::where('google_id', $googleUser->id)->first();

        if ($user) {
            Auth::login($user);
            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->route('admin.login')->with('email', "Your Google account is not associated with this applicaiton") ;
        }
    }
}
