<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Admin',
            'nik' => '1234567890123456',
            'username' => 'admin',
            'password' => Hash::make('password'),
            'email' => 'admin@example.com',
        ]);
        DB::table('users')->insert([
            'name' => 'Kepala Dinas',
            'nik' => '233423423423423',
            'username' => 'kadinas',
            'password' => Hash::make('password'),
            'email' => 'kadinas@example.com',
        ]);
        DB::table('users')->insert([
            'name' => 'Pegawai',
            'nik' => '56437776456465',
            'username' => 'pegawai',
            'password' => Hash::make('password'),
            'email' => 'pegawai@example.com',
        ]);
    }
}
