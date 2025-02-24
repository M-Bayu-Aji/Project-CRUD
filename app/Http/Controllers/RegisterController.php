<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class RegisterController extends Controller
{
    public function index()
    {
        return view('register.index', [
            'title' => 'Register',
            'active' => 'register'
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:16',
            'username' => ['required', 'min:3', 'max:8', 'unique:users,username'],
            'email' => 'required|email:dns|unique:users',
            'password' => 'required|min:4|max:255'
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);

        User::create($validatedData);

        // $request->session()->flash('success', 'Registration successfull! Please login');

        return redirect()->route('welcome')->with('success', 'Registration successful! Please login');
    }

    public function deleteAccount($id) {
        User::findOrFail($id)->delete();
        
        return redirect()->route('login')->with('success', 'Berhasil menghapus akun!');
    }
}