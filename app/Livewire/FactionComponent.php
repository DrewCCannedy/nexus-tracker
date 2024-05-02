<?php

namespace App\Livewire;

use App\Models\Faction;
use Livewire\Component;

class FactionComponent extends Component
{
    public $name;
    public $factionLeaders = [];

    public function render()
    {
        $factions = Faction::with('factionLeaders')->get();
        return view('livewire.faction-component', compact('factions'));
    }

    public function create()
    {
        $faction = Faction::create([
            'name' => $this->name,
        ]);

        foreach ($this->factionLeaders as $leader) {
            $faction->factionLeaders()->create(['name' => $leader]);
        }

        $this->reset();
    }

    public function delete($id)
    {
        Faction::findOrFail($id)->delete();
    }

    public function addLeader()
    {
        $this->factionLeaders[] = '';
    }

    public function removeLeader($index)
    {
        unset($this->factionLeaders[$index]);
        $this->factionLeaders = array_values($this->factionLeaders);
    }
}
