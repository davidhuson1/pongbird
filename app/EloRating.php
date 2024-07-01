<?php

namespace App;

use App\Models\HistoricRankings;
use App\Models\HistoricRatings;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class EloRating
{
    /**
     * @var int K Factor for ELO rating.
     * The maximum possible adjustment per game, called the K-factor, 
     * was set at K = 16 for masters and K = 32 for weaker players. 
     * All top players have a K-factor of 10, which means that the maximum 
     * ratings change from a single game is a little less than 10 points
     */
    const KFACTOR = 16;

    const WIN = 1;
    const LOSS = 0;
    const TIE = 0.5;


    public static function getNewRatingForMatch($opponentA, $opponentB,  int $scoreA, int $scoreB)
    {
        $currentRatingA = User::find($opponentA)->rating;
        $currentRatingB = User::find($opponentB)->rating;

        $expectedScoreA = 1 / (1 + (10 ** (($currentRatingB - $currentRatingA) / 400)));
        $expectedScoreB = 1 / (1 + (10 ** (($currentRatingA - $currentRatingB) / 400)));

        if ($scoreA > $scoreB) {
            $scoreA = self::WIN;
            $scoreB = self::LOSS;
        } elseif ($scoreA < $scoreB) {
            $scoreA = self::LOSS;
            $scoreB = self::WIN;
        } else {
            $scoreA = self::TIE;
            $scoreB = self::TIE;
        }

        $newRatingA = (int)round($currentRatingA + (self::KFACTOR * ($scoreA - $expectedScoreA)));
        $newRatingB = (int)round($currentRatingB + (self::KFACTOR * ($scoreB - $expectedScoreB)));

        User::find($opponentA)->update(['rating' => $newRatingA]);
        User::find($opponentB)->update(['rating' => $newRatingB]);

        $historic_ratings = [
            [
                'user_id' => $opponentA,
                'rating' => $newRatingA,
                'created_at' =>  Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => $opponentB,
                'rating' => $newRatingB,
                'created_at' =>  Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ];

        HistoricRatings::insert($historic_ratings);


        // HistoricRatings::create([
        //     'user_id' => $opponentA,
        //     'rating' => $newRatingA,
        // ]);

        // HistoricRatings::create([
        //     'user_id' => $opponentB,
        //     'rating' => $newRatingB,
        // ]);

        return [
            "expected score A" => $expectedScoreA,
            "expected score B" => $expectedScoreB,
            "score A" => $scoreA,
            "score B" => $scoreB,
            "currentRatingA" => $currentRatingA,
            "currentRatingB" => $currentRatingB,
            "newRatingA" => $newRatingA,
            "newRatingB" => $newRatingB
        ];
    }
}
