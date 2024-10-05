<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            [
                'nama_role' => 'Merchant',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_role' => 'Customer',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
