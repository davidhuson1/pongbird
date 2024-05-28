<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class User extends Authenticatable implements MustVerifyEmail
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
        'rating'
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

    public function user()
    {
        return $this->hasMany(Matches::class);
    }

    public function opponent_a()
    {
        return $this->hasMany(Matches::class, 'opponent_a');
    }

    public function opponent_b()
    {
        return $this->hasMany(Matches::class, 'opponent_b');
    }

    public function matches()
    {
        // return $this->hasMany(Matches::class, 'user_id');
        return Matches::where('opponent_a', $this->id)
            ->orWhere('opponent_b', $this->id)
            ->get();
    }

    public function historicRatings()
    {
        return $this->hasMany(HistoricRatings::class, 'user_id');
    }

    // public function opponent_1(): HasMany
    // {
    //     return $this->hasMany(Matches::class, 'opponent_id');
    // }
}
