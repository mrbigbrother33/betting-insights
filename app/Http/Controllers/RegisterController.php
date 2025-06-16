<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class RegisterController extends Controller
{
    public function register(): View
    {
        return view('auth.register');
    }

    public function store(Request $request): RedirectResponse
    {

        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ], [
            'name.required' => 'Navn er påkrævet.',
            'email.required' => 'E-mail er påkrævet.',
            'email.email' => 'E-mail skal være en gyldig adresse.',
            'email.unique' => 'Denne e-mail er allerede registreret.',
            'password.required' => 'Adgangskode er påkrævet.',
            'password.min' => 'Adgangskoden skal være mindst 8 tegn.',
            'password.confirmed' => 'Adgangskoderne matcher ikke.',
        ]);

        // Hash the password
        $validatedData['password'] = Hash::make($validatedData['password']);

        // Create a new user
        $user = User::create($validatedData);

        return redirect()->route('home')->with('success', 'Registrering gennemført! Du kan nu logge ind.');
    }
}
