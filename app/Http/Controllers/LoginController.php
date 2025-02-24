<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    public function index()
    {
        return view('login.index', [
            'title' => 'Login',
            'active' => 'login'
        ]);
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required'
        ], [
            'email.required' => 'Email harus diisi',
            'email.email' => 'Masukkan email yang valid',
            'password.required' => 'Password harus diisi',

        ]);

        $user = User::where('email', $credentials['email'])->first();

        if (!$user) {
            return back()->withErrors([
                'email' => 'Masukkan email yang valid.'
            ]);
        }

        // Cek apakah password benar menggunakan Auth::attempt()
        if (!Auth::attempt($credentials)) {
            return back()->withErrors([
                'password' => 'Password yang Anda masukkan salah.'
            ]);
        }

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            if (Auth::user()->role == 'admin') {
                return redirect()->intended('/admin/dashboard');
            }
            
            return redirect()->intended('/welcome');
        }

        return back()->with('loginError', 'Login failed!');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('logout', 'Anda telah logout!');
    }
}
