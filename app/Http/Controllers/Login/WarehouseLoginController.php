<?php

namespace App\Http\Controllers\Login;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use App\Http\Controllers\Login\BaseLoginController;

class WarehouseLoginController extends BaseLoginController
{
    public function warehouseLoginForm()
    {
        return view('Login.Logins.warehouse-store-login');
    }

    public function login(Request $request)
    {
        // Validate login input with ends_with directly in the login method
        $request->validate([
            'email' => 'required|email|ends_with:rrjva.org,RRJVA.ORG',
            'password' => 'required',
        ]);

        // Check if the email exists
        $user = $this->checkEmailExists($request->email);

        // If user is not found, return error
        if (!$user) {
            return redirect()->route('warehouse.login')->withErrors(['email_not_found' => 'No account found with this email address.']);
        }

        // Attempt login using BaseLoginController method
        if (Auth::attempt($request->only('email', 'password'))) {
            return $this->redirectWarehouseStoreUser(Auth::user());
        }

        // If login fails, redirect back with password error
        return redirect()->route('warehouse.login')->withErrors(['password_incorrect' => 'Password is incorrect.']);
    }

    public function redirectWarehouseStoreUser($user)
    {
        switch ($user->warehouse_role) {
            case 'Warehouse Supervisor':
                return redirect()->route('warehouse.warehouse-supervisor.dashboard');
            case 'Warehouse Technician':
                return redirect()->route('warehouse.warehouse-technician.dashboard');
            case 'Property':
                return redirect()->route('warehouse.property.dashboard');
            case 'Supervisor':
                return redirect()->route('warehouse.supervisor.dashboard');
            case 'Requestor':
                return redirect()->route('warehouse.requestor.dashboard');
            default:
                return redirect()->route('warehouse.login')->withErrors(
                    ['email' => 'Something is wrong with you account. Please contact MIU']);
        }
    }

    public function warehouseForgotPasswordForm()
    {
        return parent::showForgotPasswordForm('Login.Forgots.warehouse-store-forgot-password');
    }

    public function logout(Request $request, $route = 'warehouse.login')
    {
        // Perform the standard logout
        Auth::logout();

        // Invalidate the session to delete the cookie
        $request->session()->invalidate();
        Cookie::queue(Cookie::forget('XSRF-TOKEN'));
        Cookie::queue(Cookie::forget('remember_token'));

        // Redirect to the specified application
        return redirect()->route($route);
    }
}
