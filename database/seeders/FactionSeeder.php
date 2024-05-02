<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\{
    Faction,
    FactionLeader
};

class FactionSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'faction_name' => 'United Nations of Earth',
                'leader_name' => 'Dolores Muwanga (Patriot)'
            ],
            [
                'faction_name' => 'United Nations of Earth',
                'leader_name' => 'Rana Al-Dimashqi (Diplomat)'
            ],
            [
                'faction_name' => 'United Nations of Earth',
                'leader_name' => 'Atticus Levdis (Admiral)'
            ],
            [
                'faction_name' => 'Voor Technocracy',
                'leader_name' => 'Vex Kai\'Fa (Technocrat)'
            ],
            [
                'faction_name' => 'Voor Technocracy',
                'leader_name' => 'Sapra Vun (Teacher)'
            ],
            [
                'faction_name' => 'Voor Technocracy',
                'leader_name' => 'Perak Teras (Explorer)'
            ],
            [
                'faction_name' => 'Kel-Azaan Republic',
                'leader_name' => 'Krexax (Aggressor)'
            ],
            [
                'faction_name' => 'Kel-Azaan Republic',
                'leader_name' => 'Knav Xankikin (Hunter)'
            ],
            [
                'faction_name' => 'Kel-Azaan Republic',
                'leader_name' => 'Luk Ekbokin (Conqueror)'
            ],
            [
                'faction_name' => 'Turtuon Federation',
                'leader_name' => 'Bofaar Juk XXIV (Statesman)'
            ],
            [
                'faction_name' => 'Turtuon Federation',
                'leader_name' => 'Riin Manti XVIII (Monumentalist)'
            ],
            [
                'faction_name' => 'Turtuon Federation',
                'leader_name' => 'Moonsar IX (Nationalist)'
            ],
            [
                'faction_name' => 'Chinoor Combine',
                'leader_name' => 'Jurrba Shogg (Profiteer)'
            ],
            [
                'faction_name' => 'Chinoor Combine',
                'leader_name' => 'Gaschi (Exploiter)'
            ],
            [
                'faction_name' => 'Chinoor Combine',
                'leader_name' => 'Paggro (Mercenary)'
            ],
            [
                'faction_name' => 'Ix\'Idar Star Collective',
                'leader_name' => 'Xid\'Ixa\'Xire\'Idon (Collective)'
            ],
            [
                'faction_name' => 'Ix\'Idar Star Collective',
                'leader_name' => 'Tek\'La\'Gon (Proliferator)'
            ],
            [
                'faction_name' => 'Ix\'Idar Star Collective',
                'leader_name' => 'Ru\'Xad\'Mon\'A (Infiltrator)'
            ],
            [
                'faction_name' => 'Kingdom of Yondarim',
                'leader_name' => 'Jeerak (Crusader)'
            ],
            [
                'faction_name' => 'Kingdom of Yondarim',
                'leader_name' => 'Kreemak Koriik (Inquisitor)'
            ],
            [
                'faction_name' => 'Kingdom of Yondarim',
                'leader_name' => 'Sakeeri (God-Queen)'
            ],
            [
                'faction_name' => 'Roderian Empire',
                'leader_name' => 'Raktik (Overseer)'
            ],
            [
                'faction_name' => 'Roderian Empire',
                'leader_name' => 'Mikkel (Mechanic)'
            ],
            [
                'faction_name' => 'Roderian Empire',
                'leader_name' => 'Saarn\'K (Instigator)'
            ],
            [
                'faction_name' => 'Glebsig Foundation',
                'leader_name' => 'Thir-Roog (Visionary)'
            ],
            [
                'faction_name' => 'Glebsig Foundation',
                'leader_name' => 'Malgugg (Socialite)'
            ],
            [
                'faction_name' => 'Glebsig Foundation',
                'leader_name' => 'Sungam (Protector)'
            ],
        ];

        foreach ($data as $item) {
            $faction = Faction::updateOrCreate(
                ['name' => $item['faction_name']]
            );

            FactionLeader::create([
                'faction_id' => $faction->id,
                'name' => $item['leader_name'],
            ]);
        }
    }
}
