<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matches extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'opponent_1',
        'opponent_2',
        'score_opponent_1',
        'score_opponent_2',
        'winner'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function user_1()
    {
        return $this->belongsTo(User::class, 'opponent_1');
    }

    public function user_2()
    {
        return $this->belongsTo(User::class, 'opponent_2');
    }
}
