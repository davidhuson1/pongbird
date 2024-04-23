<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'rank'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // public function matches(): HasMany
    // {
    //     return $this->hasMany(Matches::class);
    // }

    public function opponent_1()
    {
        return $this->belongsTo(Matches::class, 'opponent_1');
    }

    public function opponent_2()
    {
        return $this->belongsTo(Matches::class, 'opponent_2');
    }

    public function matches()
    {
        return Matches::where('opponent1_id', $this->id)
            ->orWhere('opponent2_id', $this->id)
            ->get();
    }


    // public function opponent_1(): HasMany
    // {
    //     return $this->hasMany(Matches::class, 'opponent_id');
    // }
}