<?php

namespace Database\Seeders;

use App\Models\Player;
use Illuminate\Database\Seeder;

class PlayerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $names = ['Drew', 'Chad', 'Matt', 'Noah', 'Isaac', 'Thomas', 'David'];

        foreach ($names as $name) {
            Player::create([
                'name' => $name,
            ]);
        }
    }
}
