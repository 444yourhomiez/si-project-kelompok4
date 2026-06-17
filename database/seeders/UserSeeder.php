<?php

namespace Database\Seeders;

use App\Models\Anggota;
use App\Models\JadwalWawancara;
use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $jadwalId = JadwalWawancara::first()?->id;

        // ==================================================
        // USER 1
        // SUDAH DISETUJUI
        // BELUM 6 BULAN
        // ==================================================

        $user1 = User::create([
            'nama_user' => 'Anggota Baru',
            'email' => 'baru@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'anggota',
            'status' => 'disetujui',
        ]);

        Anggota::create([
            'user_id' => $user1->id,
            'jadwal_id' => $jadwalId,

            'kode_anggota' => 'A-000001',

            'nama_anggota' => 'Anggota Baru',
            'no_ktp' => '3201000000000001',
            'no_hp' => '081111111111',

            'alamat' => 'Cimahi',
            'tempat_lahir' => 'Bandung',
            'tanggal_lahir' => '2000-01-01',

            'jenis_kelamin' => 'Laki-laki',
            'agama' => 'Islam',

            'nama_ibu_kandung' => 'Ibu Baru',
            'nama_ahli_waris' => 'Ahli Waris Baru',

            'hubungan_ahli_waris' => 'Ayah',

            'status_rumah' => 'Milik Sendiri',

            'penghasilan' => 'Rp 2.000.000 - Rp. 3.000.000',

            // BELUM 6 BULAN
            'tanggal_daftar' => now()->subMonths(3),
        ]);

        // ==================================================
        // USER 2
        // SUDAH DISETUJUI
        // SUDAH > 6 BULAN
        // ==================================================

        $user2 = User::create([
            'nama_user' => 'Anggota Lama',
            'email' => 'lama@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'anggota',
            'status' => 'disetujui',
        ]);

        Anggota::create([
            'user_id' => $user2->id,
            'jadwal_id' => $jadwalId,

            'kode_anggota' => 'A-000002',

            'nama_anggota' => 'Anggota Lama',
            'no_ktp' => '3201000000000002',
            'no_hp' => '082222222222',

            'alamat' => 'Bandung',
            'tempat_lahir' => 'Bandung',
            'tanggal_lahir' => '1998-01-01',

            'jenis_kelamin' => 'Laki-laki',
            'agama' => 'Islam',

            'nama_ibu_kandung' => 'Ibu Lama',
            'nama_ahli_waris' => 'Ahli Waris Lama',

            'hubungan_ahli_waris' => 'Ibu',

            'status_rumah' => 'Milik Sendiri',

            'penghasilan' => 'Diatas Rp 5.000.000',

            // SUDAH LEBIH DARI 6 BULAN
            'tanggal_daftar' => now()->subMonths(8),
        ]);

        // ==================================================
        // USER 3
        // BELUM DISETUJUI
        // ==================================================

        $user3 = User::create([
            'nama_user' => 'Calon Anggota',
            'email' => 'calon@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'anggota',
            'status' => 'menunggu',
        ]);

        Anggota::create([
            'user_id' => $user3->id,
            'jadwal_id' => $jadwalId,

            'kode_anggota' => null,

            'nama_anggota' => 'Calon Anggota',
            'no_ktp' => '3201000000000003',
            'no_hp' => '083333333333',

            'alamat' => 'Cimahi',
            'tempat_lahir' => 'Cimahi',
            'tanggal_lahir' => '2001-01-01',

            'jenis_kelamin' => 'Perempuan',
            'agama' => 'Islam',

            'nama_ibu_kandung' => 'Ibu Calon',
            'nama_ahli_waris' => 'Ahli Waris Calon',

            'hubungan_ahli_waris' => 'Ibu',

            'status_rumah' => 'Sewa',

            'penghasilan' => 'Rp 1.000.000 - Rp. 2.000.000',

            'tanggal_daftar' => now(),
        ]);
    }
}
