<?php

namespace App\Livewire;

use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
use Livewire\Component;

use App\Models\{
    Faction,
    Game,
    Player
};

class GameEdit extends Component
{
    public $date;
    public $gamePlayers;
    public $factions;
    public $players;
    public $game;

    public function mount(Game $game)
    {
        $this->date = $game->date;
        $this->players = Player::all()->toArray();
        $this->factions = Faction::with('factionLeaders')->get()->toArray();
        $this->gamePlayers = $game->gamePlayers()->get()->toArray();
        $this->game = $game;
    }

    public function render()
    {
        return view('livewire.game-edit');
    }

    public function edit()
    {
        $this->game->date = $this->date;
        $this->game->gamePlayers()->delete();

        foreach ($this->gamePlayers as $player) {
            $this->game->gamePlayers()->create([
                'place' => $player['place'],
                'faction_leader_id' => $player['faction_leader_id'],
                'player_id' => $player['player_id'],
            ]);
        }

        $this->game->save();

        return redirect()->to('games');
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
