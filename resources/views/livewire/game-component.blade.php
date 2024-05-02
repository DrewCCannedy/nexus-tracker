<div>
    <div class="mb-3">
        <label for="date" class="form-label">Date:</label>
        <input type="date" id="date" wire:model="date" class="form-control">
    </div>

    @foreach($gamePlayers as $index => $player)
        <div class="mb-3">
            <label for="place{{ $index }}" class="form-label">Place:</label>
            <input type="text" id="place{{ $index }}" wire:model="gamePlayers.{{ $index }}.place" class="form-control">
            <label for="faction_leader{{ $index }}" class="form-label">Faction Leader:</label>
            <select id="faction_leader{{ $index }}" wire:model="gamePlayers.{{ $index }}.factionLeaderId" class="form-control">
                <option value="">Select Faction Leader</option>
                @foreach($factions as $faction)
                    <optgroup label="{{ $faction->name }}">
                        @foreach($faction->factionLeaders as $leader)
                            <option value="{{ $leader->id }}">{{ $leader->name }} ({{ $leader->faction->name }})</option>
                        @endforeach
                    </optgroup>
                @endforeach
            </select>
            <label for="player{{ $index }}" class="form-label">Player:</label>
            <select id="player{{ $index }}" wire:model="gamePlayers.{{ $index }}.playerId" class="form-control">
                <option value="">Select Player</option>
                @foreach($players as $player)
                    <option value="{{ $player->id }}">{{ $player->name }}</option>
                @endforeach
            </select>
            <button wire:click="removeGamePlayer({{ $index }})" class="btn btn-danger">Remove</button>
        </div>
    @endforeach

    <button wire:click="addGamePlayer" class="btn btn-secondary">Add Game Player</button>

    <button wire:click="create" class="btn btn-primary">Create Game</button>

    <table class="table mt-3">
        <thead>
            <tr>
                <th>Date</th>
                <th>Place</th>
                <th>Faction Leader</th>
                <th>Player</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($games as $game)
                <tr>
                    <td rowspan="{{ count($game->gamePlayers) }}">{{ $game->date }}</td>
                    @foreach($game->gamePlayers as $index => $gamePlayer)
                        @if($index > 0)
                            <tr>
                        @endif
                        <td>{{ $gamePlayer->place }}</td>
                        <td>{{ $gamePlayer->factionLeader->name }} ({{ $gamePlayer->factionLeader->faction->name }})</td>
                        <td>{{ $gamePlayer->player->name }}</td>
                        <td>
                            @if($index == 0)
                                <button wire:click="delete({{ $game->id }})" class="btn btn-danger">Delete</button>
                            @endif
                        </td>
                        @if($index > 0)
                            </tr>
                        @endif
                    @endforeach
                    @if($game->gamePlayers->isEmpty())
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><button wire:click="delete({{ $game->id }})" class="btn btn-danger">Delete</button></td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
