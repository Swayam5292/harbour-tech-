<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Simple hardcoded admin password for portfolio manager
        $adminPassword = env('ADMIN_PASSWORD', 'admin123'); // Default password if not set in .env

        if ($request->password === $adminPassword) {
            session(['is_admin' => true]);
            return redirect('/admin_dashboard.html');
        }

        return redirect('/login.html?error=1');
    }

    public function logout()
    {
        session()->forget('is_admin');
        return redirect('/login.html');
    }
}
