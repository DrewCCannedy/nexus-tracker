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

class GameCreate extends Component
{
    public $date;
    public $gamePlayers = [];
    public $factions;
    public $players;

    public function mount()
    {
        $this->date = Carbon::today()->toDateString();
        $this->players = Player::all()->toArray();
        $this->factions = Faction::with('factionLeaders')->get()->toArray();

        $this->addGamePlayer();
        $this->addGamePlayer();
        $this->addGamePlayer();
        $this->addGamePlayer();
    }

    public function render()
    {
        return view('livewire.game-create');
    }

    public function create()
    {
        $game = Game::create([
            'date' => $this->date,
        ]);

        foreach ($this->gamePlayers as $player) {
            $game->gamePlayers()->create([
                'place' => $player['place'],
                'faction_leader_id' => $player['factionLeaderId'],
                'player_id' => $player['playerId'],
            ]);
        }

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
