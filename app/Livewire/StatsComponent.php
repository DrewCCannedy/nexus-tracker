<?php

namespace App\Livewire;

use Asantibanez\LivewireCharts\Models\ColumnChartModel;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

use App\Models\{
    Faction,
    FactionLeader,
    Player
};

class StatsComponent extends Component
{
    public $chartTypes;
    public $chartType;
    public $moreChartTypes;
    public $moreChartType;
    public $playerNames;
    public $selectedPlayer;

    private $colors = [
        '#1f77b4',
        '#ff7f0e',
        '#2ca02c',
        '#d62728',
        '#9467bd',
        '#8c564b',
        '#e377c2',
        '#7f7f7f',
        '#bcbd22',
        '#17becf',
        '#aec7e8',
        '#ffbb78',
        '#98df8a',
        '#ff9896',
        '#c5b0d5',
        '#c49c94',
        '#1f77b4',
        '#ff7f0e',
        '#2ca02c',
        '#d62728',
        '#9467bd',
        '#8c564b',
        '#e377c2',
        '#7f7f7f',
        '#bcbd22',
        '#17becf',
        '#aec7e8',
        '#ffbb78',
        '#98df8a',
        '#ff9896',
        '#c5b0d5',
        '#c49c94',
        '#1f77b4',
        '#ff7f0e',
        '#2ca02c',
        '#d62728',
        '#9467bd',
        '#8c564b',
        '#e377c2',
        '#7f7f7f',
        '#bcbd22',
        '#17becf',
        '#aec7e8',
        '#ffbb78',
        '#98df8a',
        '#ff9896',
        '#c5b0d5',
        '#c49c94',
        '#1f77b4',
        '#ff7f0e',
        '#2ca02c',
        '#d62728',
        '#9467bd',
        '#8c564b',
        '#e377c2',
        '#7f7f7f',
        '#bcbd22',
        '#17becf',
        '#aec7e8',
        '#ffbb78',
        '#98df8a',
        '#ff9896',
        '#c5b0d5',
        '#c49c94'
    ];

    public function mount()
    {
        $this->chartTypes = ["Player", "Faction", "Leader"];
        $this->moreChartTypes = ["Wins", "Total"];
        $this->playerNames = array_merge(["All"], Player::all()->pluck('name')->toArray());
        $this->chartType = $this->chartTypes[0];
        $this->moreChartType = $this->moreChartTypes[0];
        $this->selectedPlayer = $this->playerNames[0];
    }

    public function render()
    {
        return view('livewire.stats-component', ['chart' => $this->updateChart()]);
    }

    public function updateChart()
    {
        $chart = (new ColumnChartModel())
            ->darkMode()
            ->setTitle($this->moreChartType);

        $models = [];
        switch($this->chartType) {
            case "Player":
                $models = Player::select('players.name')
                    ->leftJoin('game_players', function($join) {
                        $join->on('players.id', '=', 'game_players.player_id');
                        if($this->moreChartType == "Wins") {
                            $join->where('game_players.place', '=', 1);
                        }
                    })
                    ->groupBy('players.id')
                    ->orderBy('players.name')
                    ->selectRaw('COUNT(game_players.place) as game_players_count')
                    ->get();
                break;
            case "Faction":
                $models = Faction::select('factions.name')
                    ->join('faction_leaders', 'factions.id', '=', 'faction_leaders.faction_id')
                    ->leftJoin('game_players', function($join) {
                        $join->on('faction_leaders.id', '=', 'game_players.faction_leader_id');
                        if($this->moreChartType == "Wins") {
                            $join->where('game_players.place', '=', 1);
                        }
                    })
                    ->leftJoin('players', 'game_players.player_id', '=', 'players.id')
                    ->where(function($where) {
                        if($this->selectedPlayer != "All") {
                            $where->where('players.name', '=', $this->selectedPlayer);
                        }
                    })
                    ->groupBy('factions.id')
                    ->selectRaw('COUNT(game_players.place) as game_players_count')
                    ->orderBy('factions.id')
                    ->get();
                break;
            case "Leader":
                $models = FactionLeader::select('faction_leaders.name')
                    ->leftJoin('game_players', function($join) {
                        $join->on('faction_leaders.id', '=', 'game_players.faction_leader_id');
                        if($this->moreChartType == "Wins") {
                            $join->where('game_players.place', '=', 1);
                        }
                    })
                    ->leftJoin('players', 'game_players.player_id', '=', 'players.id')
                    ->where(function($where) {
                        if($this->selectedPlayer != "All") {
                            $where->where('players.name', '=', $this->selectedPlayer);
                        }
                    })
                    ->groupBy('faction_leaders.id')
                    ->orderBy('faction_leaders.id')
                    ->selectRaw('COUNT(game_players.place) as game_players_count')
                    ->get();
                break;
        }

        $i = 0;
        foreach($models as $model) {
            $chart->addColumn($model->name, $model->game_players_count, $this->nameToColor($model->name, $i));
            logger($model->name);
            $i++;
        }
        return $chart;
    }

    private function nameToColor($name, $i) {
        switch ($name) {
            case 'United Nations of Earth':
            case "Dolores Muwanga (Patriot)":
            case "Rana Al-Dimashqi (Diplomat)":
            case "Atticus Levdis (Admiral)":
                return '#0000FF';
            case 'Voor Technocracy':
            case "Vex Kai'Fa (Technocrat)":
            case "Sapra Vun (Teacher)":
            case "Perak Teras (Explorer)":
                return '#90EE90';
            case 'Kel-Azaan Republic':
            case "Krexax (Aggressor)":
            case "Knav Xankikin (Hunter)":
            case "Luk Ekbokin (Conqueror)":
                return '#FF00FF';
            case 'Turtuon Federation':
            case "Bofaar Juk XXIV (Statesman)":
            case "Riin Manti XVIII (Monumentalist)":
            case "Moonsar IX (Nationalist)":
                return '#006400';
            case 'Chinoor Combine':
            case "Jurrba Shogg (Profiteer)":
            case "Gaschi (Exploiter)":
            case "Paggro (Mercenary)":
                return '#FF0000';
            case "Ix'Idar Star Collective":
            case "Xid'Ixa'Xire'Idon (Collective)":
            case "Tek'La'Gon (Proliferator)":
            case "Ru'Xad'Mon'A (Infiltrator)":
                return '#FFFF00';
            case 'Kingdom of Yondarim':
            case "Jeerak (Crusader)":
            case "Kreemak Koriik (Inquisitor)":
            case "Sakeeri (God-Queen)":
                return '#FFA500';
            case 'Roderian Empire':
            case "Raktik (Overseer)":
            case "Mikkel (Mechanic)":
            case "Saarn'K (Instigator)":
                return '#A52A2A';
            case 'Glebsig Foundation':
            case "Thir-Roog (Visionary)":
            case "Malgugg (Socialite)":
            case "Sungam (Protector)":
                return '#800080';
            case 'Kilik Cooperative':
            case 'Senka Vayne (Progressive)':
            case 'Ereni (Bureaucrat)':
            case 'Iora Nahatl (Marshall)':
                return '#FFC0CB';
            case "Keepers of Ave'brenn":
            case "J'hem Vhaawr (Exalted)":
            case "Thraat Vhaawr (Seeker)":
            case "Phrennt Vhaawr (Fanatic)":
                return '#F8F8FF';
            default:
                return $this->colors[$i];
        }

    }
}
