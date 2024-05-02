<div>
    <div class="mb-3">
        <input type="text" wire:model="name" class="form-control" placeholder="Enter faction name">
    </div>
    <div class="mb-3">
        <button wire:click="addLeader" class="btn btn-secondary">Add Faction Leader</button>
    </div>

    @foreach($factionLeaders as $index => $leader)
        <div class="mb-3">
            <input type="text" wire:model="factionLeaders.{{ $index }}" class="form-control" placeholder="Enter faction leader name">
            <button wire:click="removeLeader({{ $index }})" class="btn btn-danger">Remove</button>
        </div>
    @endforeach

    <button wire:click="create" class="btn btn-primary">Create Faction</button>

    <table class="table mt-3">
        <thead>
            <tr>
                <th>Name</th>
                <th>Faction Leaders</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($factions as $faction)
            <tr>
                <td>{{ $faction->name }}</td>
                <td>
                    @foreach($faction->factionLeaders as $leader)
                        {{ $leader->name }},
                    @endforeach
                </td>
                <td>
                    <button wire:click="delete({{ $faction->id }})" class="btn btn-danger">Delete</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
