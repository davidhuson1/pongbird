<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class RankingController extends Controller
{
    public function index()
    {
        return Inertia::render('HomePage', [
            'user' => Auth::user(),
            'users' => User::select('id', 'name', 'rating')->orderBy('rating', 'desc')->get()
        ]);
    }
}
