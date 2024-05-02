<div class="card">
    <div class="card-body">
        <div class="mb-3">
            <input type="text" wire:model="name" class="form-control" placeholder="Enter player name">
        </div>
        <div class="mb-3">
            <button wire:click="create" class="btn btn-primary">Create Player</button>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($players as $player)
                <tr>
                    <td>{{ $player->name }}</td>
                    <td>
                        <button wire:click="delete({{ $player->id }})" class="btn btn-danger">Delete</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
