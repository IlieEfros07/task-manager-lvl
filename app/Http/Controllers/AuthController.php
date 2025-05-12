<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    public function createRegister()
    {
        return view('auth.register');
    }

    public function storeRegister(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);


        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']), 
        ]);

        Auth::login($user);
        $request->session()->regenerate(); 

        return redirect()->route('tasks.index')
                 ->with('success', 'Cont creat și autentificare reușită!');
    }


    public function createLogin()
    {
        return view('auth.login');
    }

    public function storeLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);


        if (Auth::attempt($credentials, $request->boolean('remember'))) { 
            $request->session()->regenerate();

            return redirect()->intended('tasks.index')
                     ->with('success', 'Autentificare reușită!');
        }

        // Eșec la autentificare
        return back()->withErrors([
            'email' => 'Datele de autentificare nu corespund înregistrărilor noastre.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')
                 ->with('success', 'Deconectare reușită!');
    }
}