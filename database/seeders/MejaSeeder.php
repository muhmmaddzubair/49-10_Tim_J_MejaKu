<?php

namespace Database\Seeders;

use App\Models\Meja;
use Illuminate\Database\Seeder;

class MejaSeeder extends Seeder
{
    public function run(): void
    {
        $dataContoh = [
            ['A01',    2, 'Indoor', 'Tersedia'],
            ['A02',    2, 'Indoor', 'Terisi'],
            ['A03',    4, 'Indoor', 'Tersedia'],
            ['A04',    4, 'Indoor', 'Dipesan'],
            ['B01',    8, 'Indoor', 'Perbaikan'],
            ['VIP-01', 4, 'VIP',    'Tersedia'],
            ['VIP-02', 8, 'VIP',    'Dipesan'],
        ];

        foreach ($dataContoh as $d) {
            Meja::updateOrCreate(
                ['nomor_meja' => $d[0]],
                ['kapasitas' => $d[1], 'zona' => $d[2], 'status' => $d[3]]
            );
        }
    }
}
