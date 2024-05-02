<?php

namespace App\Models;

use Illuminate\Database\Eloquent\{
    Factories\HasFactory,
    Relations\BelongsTo,
    Model
};

class GamePlayer extends Model
{
    use HasFactory;

    protected $fillable = [
        'place',
        'player_id',
        'game_id',
        'faction_leader_id'
    ];

    public function game(): BelongsTo
    {
        return $this->belongsTo(Game::class);
    }

    public function player(): BelongsTo
    {
        return $this->belongsTo(Player::class);
    }

    public function factionLeader(): BelongsTo
    {
        return $this->belongsTo(FactionLeader::class);
    }
}
