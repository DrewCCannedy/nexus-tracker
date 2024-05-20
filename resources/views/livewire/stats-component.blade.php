<div class="card">
    <div class="card-body">
        <h5 class="card-title">Factions</h5>
        <hr>
        <div class="row mt-2">
            <div class="col-auto">
                <label for="chart-type-picker" class="col-form-label">Chart Type:</label>
            </div>
            <div class="col-auto">
                <select id="chart-type-picker" wire:model="chartType" wire:change="updateChart" class="form-control">
                    @foreach($chartTypes as $type)
                        <option value="{{ $type }}">{{ $type }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-auto">
                <select id="more-chart-type-picker" wire:model="moreChartType" wire:change="updateChart" class="form-control">
                    @foreach($moreChartTypes as $type)
                        <option value="{{ $type }}">{{ $type }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-auto">
                <select id="player-picker" wire:model="selectedPlayer" wire:change="updateChart" class="form-control">
                    @foreach($playerNames as $player)
                        <option value="{{ $player }}">{{ $player }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="m-4" style="height: 32rem;">
            <livewire:livewire-column-chart
                key="{{ $chart->reactiveKey() }}"
                :column-chart-model="$chart"
            />
        </div>
    </div>
</div>
