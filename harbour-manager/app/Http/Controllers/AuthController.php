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
            return redirect()->route('projects.index');
        }

        return back()->withErrors(['password' => 'Invalid password']);
    }

    public function logout()
    {
        session()->forget('is_admin');
        return redirect()->route('login');
    }
}
