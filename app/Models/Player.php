<?php

namespace App\Models;

use Illuminate\Database\Eloquent\{
    Factories\HasFactory,
    Relations\HasMany,
    Model
};

class Player extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function gamePlayers(): HasMany
    {
        return $this->hasMany(GamePlayer::class);
    }
}
