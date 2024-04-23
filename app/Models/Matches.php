<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matches extends Model
{
    use HasFactory;

    protected $fillable = [
        'opponent_1',
        'opponent_2',
        'score_opponent_1',
        'score_opponent_2',
        'winner'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function opponent_1()
    {
        return $this->hasOne(User::class, 'opponent_1');
    }

    public function opponent_2()
    {
        return $this->hasOne(User::class, 'opponent_2');
    }
}
