<?php

namespace App;

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

    public static function getNewRatingForMatch($ratingA, $ratingB, int $scoreA, int $scoreB)
    {
        echo "calculate rating";
        $expectedScoreA = 1 / (1 + (10 ** (($ratingB - $ratingA) / 400)));
        $expectedScoreB = 1 / (1 + (10 ** (($ratingA - $ratingB) / 400)));

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

        $newRatingA = $ratingA + (self::KFACTOR * ($scoreA - $expectedScoreA));
        $newRatingB = $ratingB + (self::KFACTOR * ($scoreB - $expectedScoreB));

        return [
            "expected score A" => $expectedScoreA,
            "expected score B" => $expectedScoreB,
            "score A" => $scoreA,
            "score B" => $scoreB,
            "newRatingA" => $newRatingA,
            "newRatingB" => $newRatingB
        ];
    }

    protected function _getExpectedScores($ratingA, $ratingB)
    {

        $expectedScoreA = 1 / (1 + (10 ** (($ratingB - $ratingA) / 400)));
        $expectedScoreB = 1 / (1 + (10 ** (($ratingA - $ratingB) / 400)));
        return [$expectedScoreA, $expectedScoreB];
    }
}
