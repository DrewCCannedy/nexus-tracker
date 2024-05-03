<?php

namespace App\Livewire;

use Illuminate\Contracts\Database\Query\Builder;
use Livewire\Component;

use App\Models\{
    Faction,
    Game,
    Player
};

class GameComponent extends Component
{
    public function render()
    {
        $games = Game::with([
            'gamePlayers' => function (Builder $query) {
                $query->orderBy('place');
            },
            'gamePlayers.factionLeader',
            'gamePlayers.player',
            'gamePlayers.factionLeader.faction'
        ])->orderByDesc('date')->get();

        return view('livewire.game-component', compact('games'));
    }

    public function delete($id)
    {
        Game::findOrFail($id)->delete();
    }

    public function edit($id)
    {
        return redirect()->route('games.edit', ['game' => $id]);
    }
}
