<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            'nama_role' => 'Admin',
        ]);
        DB::table('roles')->insert([
            'nama_role' => 'Kepala Bidang',
        ]);
        DB::table('roles')->insert([
            'nama_role' => 'Pegawai',
        ]);
    }
}
