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
        '#c49c94'
    ];

    public function mount()
    {
        $this->chartTypes = ["player", "faction", "leader"];
        $this->moreChartTypes = ["wins", "total"];
        $this->chartType = $this->chartTypes[0];
        $this->moreChartType = $this->moreChartTypes[0];
    }

    public function render()
    {
        return view('livewire.wins-component', ['chart' => $this->updateChart()]);
    }

    public function updateChart()
    {
        $chart = (new ColumnChartModel())
            ->setTitle('Wins');

        $models = [];
        switch($this->chartType) {
            case "player":
                $models = Player::select('players.name')
                    ->leftJoin('game_players', function($join) {
                        $join->on('players.id', '=', 'game_players.player_id');
                        if($this->moreChartType == "wins") {
                            $join->where('game_players.place', '=', 1);
                        }
                    })
                    ->groupBy('players.id')
                    ->selectRaw('COUNT(game_players.place) as game_players_count')
                    ->get();
                break;
            case "faction":
                $models = Faction::select('factions.name')
                    ->join('faction_leaders', 'factions.id', '=', 'faction_leaders.faction_id')
                    ->leftJoin('game_players', function($join) {
                        $join->on('faction_leaders.id', '=', 'game_players.faction_leader_id');
                        if($this->moreChartType == "wins") {
                            $join->where('game_players.place', '=', 1);
                        }
                    })
                    ->groupBy('factions.id')
                    ->selectRaw('COUNT(game_players.place) as game_players_count')
                    ->get();
                break;
            case "leader":
                $models = FactionLeader::select('faction_leaders.name')
                    ->leftJoin('game_players', function($join) {
                        $join->on('faction_leaders.id', '=', 'game_players.faction_leader_id');
                        if($this->moreChartType == "wins") {
                            $join->where('game_players.place', '=', 1);
                        }
                    })
                    ->groupBy('faction_leaders.id')
                    ->selectRaw('COUNT(game_players.place) as game_players_count')
                    ->get();
                break;
        }

        $i = 0;
        foreach($models as $model) {
            $chart->addColumn($model->name, $model->game_players_count, $this->colors[$i]);
            $i++;
        }

        return $chart;
    }
}
