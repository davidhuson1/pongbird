<?php

namespace App\Http\Controllers;

use App\Http\Resources\MatchesResource;
use App\Models\Matches;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\EloRating;
use App\Models\User;
use Inertia\Inertia;

class MatchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('MatchesPage', [
            'user' => Auth::user(),
            'matches' => MatchesResource::collection(
                Matches::where('opponent_a', Auth::id())
                    ->orWhere('opponent_b', Auth::id())->get()
            )
        ]);
        // return MatchesResource::collection(
        //     Matches::where('opponent_a', Auth::id())
        //         ->orWhere('opponent_b', Auth::id())->get()
        // );
        // return Matches::where('opponent_1', Auth::id())
        //     ->orWhere('opponent_2', Auth::id())->get();
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return 'create';
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            // 'user_id' => 'required|numeric',
            'opponent_a' => 'required|numeric',
            'opponent_b' => 'required|numeric',
            'score_opponent_a' => 'required|integer|min:0',
            'score_opponent_b' => 'required|integer|min:0',
            // 'winner' => 'string|max:20'
        ]);

        $scoreOpponentA = $request->score_opponent_a;
        $scoreOpponentB = $request->score_opponent_b;
        $opponentA = $request->opponent_a;
        $opponentB = $request->opponent_b;

        if ($scoreOpponentA > $scoreOpponentB) {
            $winner = "opponent_a";
        } elseif ($scoreOpponentA < $scoreOpponentB) {
            $winner = "opponent_b";
        } else {
            $winner = "tie";
        }

        EloRating::getNewRatingForMatch($opponentA, $opponentB, $scoreOpponentA, $scoreOpponentB);

        $match = Matches::create([
            'user_id' => Auth::user()->id,
            'opponent_a' => $request->opponent_a,
            'opponent_b' => $request->opponent_b,
            'score_opponent_a' => $request->score_opponent_a,
            'score_opponent_b' => $request->score_opponent_b,
            'winner' => $winner,
        ]);

        // DB::table('users')
        //     ->where('id', 41)
        //     ->update(['rank' => $newEloRating[NewRatingA]);

        return new MatchesResource($match);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
