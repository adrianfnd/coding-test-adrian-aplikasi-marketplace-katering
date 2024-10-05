<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JenisMakananSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('jenis_makanans')->insert([
            [
                'nama_jenis_makanan' => 'Daging',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_jenis_makanan' => 'Sayuran',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_jenis_makanan' => 'Buah-buahan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_jenis_makanan' => 'Nasi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_jenis_makanan' => 'Ikan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_jenis_makanan' => 'Roti',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
