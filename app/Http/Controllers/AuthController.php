<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Rules\SpecificDomainsOnly;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;
use Illuminate\Auth\Events\Registered;

class AuthController extends Controller
{
    public function login(Request $request)
    {

        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials, $request->remember)) {
            $request->session()->regenerate();

            return response()->json([
                'user' => auth()->user(),
                'session_id' => session()->getId()
            ]);
        }
        throw ValidationException::withMessages([
            'email' => 'Invalid credentials'
        ]);
    }


    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:255', 'string', 'unique:users', new SpecificDomainsOnly],
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:6'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        event(new Registered($user));

        Auth::login($user);

        return response([
            'user' => $user,
            'token' => $user->createToken('API token of ' . $user->name)->plainTextToken
        ], 200, []);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
    }



    public function show()
    {
        return Inertia::render('LoginPage', []);
    }
    public function signup()
    {
        return Inertia::render('RegisterPage', []);
    }

    public function sendVerificationEmail(Request $request)
    {
        $request->user()->sendEmailVerificationNotification();

        return response([], 200, []);
    }
}
