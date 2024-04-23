<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email|string',
            'password' => 'required|string|min:6'
        ]);

        if (Auth::attempt($credentials)) {

            $user = User::where('email', $request->email)->first();

            return response([
                'user' => $user,
                'token' => $user->createToken('API token of' . $user->name)->plainTextToken
            ]);
            // $request->session()->regenerate();

            // return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }




    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255|string',
            'email' => 'required|email',
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
        return response('this is logout', 200, []);
    }
}
