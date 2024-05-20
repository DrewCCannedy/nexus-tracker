<div class="card">
    <div class="card-body">
        <h5 class="card-title">Games</h5>
        <hr>
        <a href="{{ route('games.create') }}" class="btn btn-primary">New Game</a>
        <table class="table mt-2">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Action</th>
                    <th>Place</th>
                    <th>Faction Leader</th>
                    <th>Player</th>
                </tr>
            </thead>
            <tbody>
                @foreach($games as $game)
                    <tr>
                        <td rowspan="{{ count($game->gamePlayers) }}">{{ \Carbon\Carbon::parse($game->date)->format('F jS - Y') }}</td>
                        <td rowspan="{{ count($game->gamePlayers) }}">
                            <button wire:click="edit({{ $game->id }})" class="btn btn-warning">Edit</button>
                            <button wire:click="delete({{ $game->id }})" class="btn btn-danger">Delete</button>
                        </td>
                        @foreach($game->gamePlayers as $index => $gamePlayer)
                            @if($index > 0)
                                <tr>
                            @endif
                            <td>{{ $gamePlayer->place }}</td>
                            <td>{{ $gamePlayer->factionLeader->name }} ({{ $gamePlayer->factionLeader->faction->name }})</td>
                            <td>{{ $gamePlayer->player->name }}</td>
                            @if($index > 0)
                                </tr>
                            @endif
                        @endforeach
                        @if($game->gamePlayers->isEmpty())
                            <td></td>
                            <td></td>
                            <td></td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $games->links() }}
    </div>
</div>
