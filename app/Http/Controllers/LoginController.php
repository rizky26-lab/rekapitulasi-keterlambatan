<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('pages.auth.login', [
            'title' => 'Login'
        ]);
    }

    // Login
    public function auth(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|exists:users,email', 
            'password' => 'required',
        ], [
            'email.exists' => 'Email ini belum tersedia',
            'email.required' => 'Email tidak boleh kosong',
            'password.required' => 'Password tidak boleh kosong',
        ]);


        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            $user = Auth::user(); 
        
            if ($user->role === 'admin') {
                return redirect()->intended(route('user.index'))->with('success', 'Admin Login Success!');
            } else {
                return redirect()->intended(route('landing'))->with('success', 'User Login Success!');
            }
        }
        

        return back()->with('LoginError', 'Login failed!');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/')->with('logout', 'Berhasil Logout!');
    }
}
