<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MatchesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => (string)$this->id,
            'attributes' => [
                'opponent_a' => $this->opponent_a,
                'opponent_b' => $this->opponent_b,
                'score_opponent_a' => $this->score_opponent_a,
                'score_opponent_b' => $this->score_opponent_b,
                'winner' => $this->winner,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at
            ],
            'relationships' => [
                'creator' => [
                    'id' => $this->user->id,
                    'name' => $this->user->name
                ],
                'opponent_a' => [
                    'id' => $this->user_a->id,
                    'name' => $this->user_a->name,
                    'rating' => $this->user_a->rating,
                ],
                'opponent_b' => [
                    'id' => $this->user_b->id,
                    'name' => $this->user_b->name,
                    'rating' => $this->user_b->rating
                ]

            ]
        ];
    }
}
