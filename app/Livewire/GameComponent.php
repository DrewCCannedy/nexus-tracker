<?php

namespace App\Livewire;

use Carbon\Carbon;
use Illuminate\Contracts\Database\Query\Builder;
use Livewire\Component;

use App\Models\{
    Faction,
    Game,
    Player
};

class GameComponent extends Component
{
    public $date;
    public $gamePlayers = [];

    public function render()
    {
        $games = Game::with(['gamePlayers' => function (Builder $query) {
            $query->orderBy('place');
        }])->orderByDesc('date')->get();
        $players = Player::all();
        $factions = Faction::with('factionLeaders')->get();

        return view('livewire.game-component', compact('games', 'players', 'factions'));
    }

    public function create()
    {
        $game = Game::create([
            'date' => $this->date ?? Carbon::now()->format('Y-m-d'),
        ]);

        foreach ($this->gamePlayers as $player) {
            $game->gamePlayers()->create([
                'place' => $player['place'],
                'faction_leader_id' => $player['factionLeaderId'],
                'player_id' => $player['playerId'],
            ]);
        }

        $this->reset();
    }

    public function delete($id)
    {
        Game::findOrFail($id)->delete();
    }

    public function addGamePlayer()
    {
        $nextPlace = count($this->gamePlayers) + 1;
        $this->gamePlayers[] = [
            'place' => $nextPlace,
            'factionLeaderId' => null,
            'playerId' => null,
        ];
    }

    public function removeGamePlayer($index)
    {
        unset($this->gamePlayers[$index]);
        $this->gamePlayers = array_values($this->gamePlayers);
    }
}
