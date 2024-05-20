<?php

namespace App\Livewire;

use Illuminate\Contracts\Database\Query\Builder;

use App\Models\{
    Faction,
    Game,
    Player
};
use Livewire\{
    Component,
    WithPagination
};

class GameComponent extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $games = Game::with([
            'gamePlayers' => function (Builder $query) {
                $query->orderBy('place');
            },
            'gamePlayers.factionLeader',
            'gamePlayers.player',
            'gamePlayers.factionLeader.faction'
        ])->orderByDesc('date')->paginate(10);

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
