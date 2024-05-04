<div>
    <div class="row mb-5">
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
    </div>
    <div style="height: 32rem;">
        <livewire:livewire-column-chart
            key="{{ $chart->reactiveKey() }}"
            :column-chart-model="$chart"
        />
    </div>
</div>

