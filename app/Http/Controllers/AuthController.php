<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Validação dos campos
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Tentativa de autenticação
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('dashboard');
        }

        // Caso dê erro
        return back()->withErrors([
            'email' => 'As credenciais informadas não conferem.',
        ])->onlyInput('email');
    }

        public function logout(Request $request)
        {
            Auth::logout();
    
            $request->session()->invalidate();
            $request->session()->regenerateToken();
    
            return redirect('/login');
        }
}

