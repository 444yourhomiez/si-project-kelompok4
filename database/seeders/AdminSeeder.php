<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'pengawas@gmail.com'],
            [
                'nama_user' => 'Pengawas',
                'password' => bcrypt('pengawas'),
                'role' => 'pengawas',
                'status' => 'disetujui',
            ]
        );

        User::firstOrCreate(
            ['email' => 'manajemen1@gmail.com'],
            [
                'nama_user' => 'Manajemen 1',
                'password' => bcrypt('manajemen'),
                'role' => 'manajemen',
                'status' => 'disetujui',
            ]
        );

        User::firstOrCreate(
            ['email' => 'manajemen2@gmail.com'],
            [
                'nama_user' => 'Manajemen 2',
                'password' => bcrypt('manajemen'),
                'role' => 'manajemen',
                'status' => 'disetujui',
            ]
        );
    }
}