<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kades;

class KadesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Kades::truncate();

        Kades::create([
            'name' => 'NASRULLAH A. UKA',
            'photo_url' => 'uploads/kades/nasrullah.png',
            'tahun_jabatan' => '2018 - 2022'
        ]);

        Kades::create([
            'name' => 'VERRYSON L. BONEAN',
            'photo_url' => 'uploads/kades/verryson.png',
            'tahun_jabatan' => '2022 - 2026',
            'is_current' => true
        ]);

        Kades::create([
            'name' => 'DIAN NURHIKMA',
            'photo_url' => 'uploads/kades/dian.png',
            'tahun_jabatan' => '2014 - 2018'
        ]);

        Kades::create([
            'name' => 'ANTHON SUTRISNO',
            'photo_url' => 'uploads/kades/anthon.png',
            'tahun_jabatan' => '2010 - 2014'
        ]);
    }
}
