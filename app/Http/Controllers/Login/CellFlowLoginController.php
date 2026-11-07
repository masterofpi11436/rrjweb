<?php

namespace App\Http\Controllers\Login;

use App\Enums\CellFlowUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class CellFlowLoginController extends BaseLoginController
{
    public function cellflowLoginForm()
    {
        return view('Login.Logins.cellflow-login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email|ends_with:rrjva.org',
            'password' => 'required',
        ]);

        // Check if the email exists
        $user = $this->checkEmailExists($request->email);

        if (!$user) {
            return redirect()
                ->route('cellflow.login')
                ->withErrors([
                    'email_not_found' => 'No account found with this email address. Please contact MIU to create an account.',
                ]);
        }

        // Attempt login
        if (Auth::attempt($request->only('email', 'password'))) {

            // Regenerate session after authentication
            $request->session()->regenerate();

            return $this->redirectCellFlowUser(Auth::user());
        }

        return redirect()
            ->route('cellflow.login')
            ->withErrors([
                'password_incorrect' => 'Password is incorrect.',
            ]);
    }

    public function redirectCellFlowUser($user)
    {
        return match ($user->cellflow_role) {

            CellFlowUser::ADMIN =>
                redirect()->route('cellflow.admin.dashboard'),

            CellFlowUser::COMMAND =>
                redirect()->route('cellflow.command.dashboard'),

            CellFlowUser::MAINTENANCE =>
                redirect()->route('cellflow.maintenance.dashboard'),

            CellFlowUser::OFFICER =>
                redirect()->route('cellflow.officer.dashboard'),

            default => $this->denyCellFlowAccess(),
        };
    }

    private function denyCellFlowAccess()
    {
        Auth::logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect()
            ->route('cellflow.login')
            ->withErrors([
                'email' => 'You do not have access to CellFlow. Please contact MIU.',
            ]);
    }

    public function cellflowForgotPasswordForm()
    {
        return parent::showForgotPasswordForm(
            'Login.Forgots.cellflow-forgot-password'
        );
    }

    public function logout(Request $request, $route = 'cellflow.login')
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        Cookie::queue(Cookie::forget('XSRF-TOKEN'));
        Cookie::queue(Cookie::forget('remember_token'));

        return redirect()->route($route);
    }
}
