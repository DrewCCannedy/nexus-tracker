<?php

namespace App\Models;

use Illuminate\Database\Eloquent\{
    Factories\HasFactory,
    Relations\HasMany,
    Model
};

class Game extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
    ];

    public function gamePlayers(): HasMany
    {
        return $this->hasMany(GamePlayer::class);
    }
}
