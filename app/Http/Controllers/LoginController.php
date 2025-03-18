<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login()
    {
        return view ('auth.login');
    }

    public function store(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $remember = $request->filled('remember');
    
        if (Auth::attempt($credentials, $remember)) {
            request()->session()->regenerate();
       
            return redirect()->intended($request->input('redirect', route('dashboard')));
        }
    
        
    
        return redirect('login')->withErrors(['error' => 'Usuario o contraseña incorrectos']);
    }
    

    public function register()
    {
        return view ('users.create');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
