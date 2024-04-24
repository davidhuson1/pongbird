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
                'opponent_1' => $this->opponent_1,
                'opponent_2' => $this->opponent_2,
                'score_opponent_1' => $this->score_opponent_1,
                'score_opponent_2' => $this->score_opponent_2,
                'winner' => $this->winner,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at
            ],
            'relationships' => [
                'creator' => [
                    'id' => $this->user->id,
                    'name' => $this->user->name
                ],
                'opponent_1' => [
                    'id' => $this->user_1->id,
                    'name' => $this->user_1->name,
                    'rank' => $this->user_1->rank,
                ],
                'opponent_2' => [
                    'id' => $this->user_2->id,
                    'name' => $this->user_2->name,
                    'rank' => $this->user_2->rank
                ]

            ]
        ];
    }
}
