<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matches extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'opponent_a',
        'opponent_b',
        'score_opponent_a',
        'score_opponent_b',
        'winner',
        'rating_change_opponent_a',
        'rating_change_opponent_b',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function user_a()
    {
        return $this->belongsTo(User::class, 'opponent_a');
    }

    public function user_b()
    {
        return $this->belongsTo(User::class, 'opponent_b');
    }
}
