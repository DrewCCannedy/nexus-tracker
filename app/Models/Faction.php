<?php

namespace App\Models;

use Illuminate\Database\Eloquent\{
    Factories\HasFactory,
    Relations\HasMany,
    Model
};

class Faction extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function factionLeaders(): HasMany
    {
        return $this->hasMany(FactionLeader::class);
    }
}
