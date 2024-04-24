<?php

namespace App\Http\Controllers;

use App\Http\Resources\MatchesResource;
use App\Models\Matches;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr\Match_;

class MatchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return MatchesResource::collection(
            Matches::where('opponent_1', Auth::id())
                ->orWhere('opponent_2', Auth::id())->get()
        );
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
            'opponent_1' => 'required|numeric',
            'opponent_2' => 'required|numeric',
            'score_opponent_1' => 'required|integer|min:0',
            'score_opponent_2' => 'required|integer|min:0',
            // 'winner' => 'string|max:20'
        ]);



        if ($request->score_opponent_1 > $request->score_opponent_2) {
            $winner = "opponent_1";
        } elseif ($request->score_opponent_1 < $request->score_opponent_2) {
            $winner = "opponent_2";
        } else {
            $winner = "tie";
        }

        $match = Matches::create([
            'user_id' => Auth::user()->id,
            'opponent_1' => $request->opponent_1,
            'opponent_2' => $request->opponent_2,
            'score_opponent_1' => $request->score_opponent_1,
            'score_opponent_2' => $request->score_opponent_2,
            'winner' => $winner
        ]);

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
