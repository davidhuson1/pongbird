<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class AuthController extends Controller
{
    public function login(Request $request)
    {

        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            // $token = $request->user()->createToken('auth_token');

            return response()->json([
                'user' => auth()->user(),
                'session_id' => session()->getId()
            ]);
        }
        throw ValidationException::withMessages([
            'email' => 'Invalid credentials'
        ]);



        // if (Auth::attempt($credentials)) {
        //     return User::where('email', $request->email)->first();
        // };

        // return response(['message' => 'Wrong email or password'], 401, []);
    }
    // if (Auth::attempt($credentials)) {
    //     $user = User::where('email', $request->email)->first();

    //     return response([
    //         'user' => $user,
    //         'token' => $user->createToken('API token of' . $user->name)->plainTextToken
    //     ]);
    // $request->session()->regenerate();

    // return redirect()->intended('dashboard');
    // }

    // return back()->withErrors([
    //     'email' => 'The provided credentials do not match our records.',
    // ])->onlyInput('email');





    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255|string|unique:users,name',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:6'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

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

        // return redirect('/');
    }



    public function show()
    {
        return Inertia::render('LoginPage', []);
    }
}
