<div>
    <div class="row align-items-center">
        <div class="col-auto">
            <a href="{{ route('games') }}" class="btn btn-primary">Back</a>
        </div>
        <div class="col-auto">
            <label for="date" class="col-form-label">Date:</label>
        </div>
        <div class="col-auto">
            <input type="date" id="date" wire:model="date" value="{{ $date }}" class="form-control">
        </div>
        <div class="col-auto">
            <button wire:click="addGamePlayer" class="btn btn-secondary">Add Player</button>
        </div>
        <div class="col-auto">
            <button wire:click="edit" class="btn btn-primary">Save Game</button>
        </div>
    </div>
    <hr>
    @foreach($gamePlayers as $index => $player)
        <div class="row my-2" wire:key="{{ $index }}">
            <div class="col-auto">
                <label for="place{{ $index }}" class="col-form-label">Place:</label>
            </div>
            <div class="col-1">
                <input type="number" id="place{{ $index }}" wire:model="gamePlayers.{{ $index }}.place" class="form-control">
            </div>
            <div class="col-auto">
                <select id="faction_leader{{ $index }}" wire:model="gamePlayers.{{ $index }}.faction_leader_id" class="form-control">
                    <option value="">Select Faction Leader</option>
                    @foreach($factions as $faction)
                        <optgroup label="{{ $faction["name"] }}">
                            @foreach($faction["faction_leaders"] as $leader)
                                <option value="{{ $leader["id"] }}">{{ $leader["name"] }}</option>
                            @endforeach
                        </optgroup>
                    @endforeach
                </select>
            </div>
            <div class="col-auto">
                <select id="player{{ $index }}" wire:model="gamePlayers.{{ $index }}.player_id" class="form-control">
                    <option value="">Select Player</option>
                    @foreach($players as $player)
                        <option value="{{ $player["id"] }}">{{ $player["name"] }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-auto">
                <button wire:click="removeGamePlayer({{ $index }})" class="btn btn-danger">Remove</button>
            </div>
        </div>
    @endforeach
</div>
