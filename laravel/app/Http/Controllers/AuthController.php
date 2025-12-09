<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|max:255',
            'password' => 'required|string|max:255',
        ]);

        // check if it is a valid user and it is validated
        if (Auth::attempt($validated) && User::where('email', '=', $validated['email'])->get('approved')[0]['approved'] == '1')
        {
            $request->session()->regenerate();
            
            return redirect()->route('home.index');
        }
        
        throw ValidationException::withMessages([
            'credentials' => 'Error: Invalid credentials',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
