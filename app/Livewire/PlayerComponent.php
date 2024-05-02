<?php

namespace App\Livewire;

use App\Models\Player;
use Livewire\Component;

class PlayerComponent extends Component
{
    public $name;

    protected $rules = [
        'name' => 'required|min:2|max:255',
    ];

    public function render()
    {
        $players = Player::all();
        return view('livewire.player-component', compact('players'));
    }

    public function create()
    {
        Player::create([
            'name' => $this->name,
        ]);
        $this->name = '';
    }

    public function delete($id)
    {
        Player::destroy($id);
    }
}
