<?php
namespace Database\Seeders;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
// use Database\Seeders\AnggotaSeeder;
use Illuminate\Database\Seeder;
class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            JadwalWawancaraSeeder::class,
            AdminSeeder::class,
            UserSeeder::class,
        ]);
    }
}
