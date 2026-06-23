<?php

namespace Database\Seeders;

use App\Models\Anggota;
use App\Models\JadwalWawancara;
use App\Models\Simpanan;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $jadwalId = JadwalWawancara::first()?->id;

        // ==================================================
        // USER 1 — SUDAH DISETUJUI — SUDAH 8 BULAN
        // ==================================================

        $user1 = User::create([
            'nama_user' => 'Anggota Lama Test',
            'email'     => 'lama@gmail.com',
            'password'  => Hash::make('password'),
            'role'      => 'anggota',
            'status'    => 'disetujui',
        ]);

        $tanggalDaftar1 = now()->subMonths(8);

        $anggota1 = Anggota::create([
            'user_id'             => $user1->id,
            'jadwal_id'           => $jadwalId,
            'kode_anggota'        => 'A-000001',
            'nama_anggota'        => 'Anggota Lama Test',
            'no_ktp'              => '3201000000000001',
            'no_hp'               => '081111111111',
            'alamat'              => 'Cimahi',
            'tempat_lahir'        => 'Bandung',
            'tanggal_lahir'       => '2000-01-01',
            'jenis_kelamin'       => 'Laki-laki',
            'agama'               => 'Islam',
            'nama_ibu_kandung'    => 'Ibu Test Satu',
            'nama_ahli_waris'     => 'Ahli Waris Satu',
            'hubungan_ahli_waris' => 'Ayah',
            'status_rumah'        => 'Milik Sendiri',
            'penghasilan'         => 'Rp 2.000.000 - Rp. 3.000.000',
            'tanggal_daftar'      => $tanggalDaftar1,
        ]);

        // Simpanan pokok saat disetujui
        Simpanan::create([
            'anggota_id'    => $anggota1->id,
            'jenis_simpanan' => 'pokok',
            'jumlah'        => 500000,
            'tanggal'       => $tanggalDaftar1,
        ]);

        // Simpanan wajib per bulan selama 8 bulan
        for ($i = 8; $i >= 1; $i--) {
            Simpanan::create([
                'anggota_id'    => $anggota1->id,
                'jenis_simpanan' => 'wajib',
                'jumlah'        => 50000,
                'tanggal'       => now()->subMonths($i),
            ]);
        }

        // Simpanan sukarela awal
        Simpanan::create([
            'anggota_id'    => $anggota1->id,
            'jenis_simpanan' => 'sukarela',
            'jumlah'        => 100000,
            'tanggal'       => $tanggalDaftar1,
        ]);

        // ==================================================
        // USER 2 — SUDAH DISETUJUI — BARU 2 BULAN
        // ==================================================

        $user2 = User::create([
            'nama_user' => 'Anggota Baru Test',
            'email'     => 'baru@gmail.com',
            'password'  => Hash::make('password'),
            'role'      => 'anggota',
            'status'    => 'disetujui',
        ]);

        $tanggalDaftar2 = now()->subMonths(2);

        $anggota2 = Anggota::create([
            'user_id'             => $user2->id,
            'jadwal_id'           => $jadwalId,
            'kode_anggota'        => 'A-000002',
            'nama_anggota'        => 'Anggota Baru Test',
            'no_ktp'              => '3201000000000002',
            'no_hp'               => '082222222222',
            'alamat'              => 'Bandung',
            'tempat_lahir'        => 'Bandung',
            'tanggal_lahir'       => '1998-01-01',
            'jenis_kelamin'       => 'Laki-laki',
            'agama'               => 'Islam',
            'nama_ibu_kandung'    => 'Ibu Test Dua',
            'nama_ahli_waris'     => 'Ahli Waris Dua',
            'hubungan_ahli_waris' => 'Ibu',
            'status_rumah'        => 'Milik Sendiri',
            'penghasilan'         => 'Diatas Rp 5.000.000',
            'tanggal_daftar'      => $tanggalDaftar2,
        ]);

        // Simpanan pokok saat disetujui
        Simpanan::create([
            'anggota_id'    => $anggota2->id,
            'jenis_simpanan' => 'pokok',
            'jumlah'        => 500000,
            'tanggal'       => $tanggalDaftar2,
        ]);

        // Simpanan wajib per bulan selama 2 bulan
        for ($i = 2; $i >= 1; $i--) {
            Simpanan::create([
                'anggota_id'    => $anggota2->id,
                'jenis_simpanan' => 'wajib',
                'jumlah'        => 50000,
                'tanggal'       => now()->subMonths($i),
            ]);
        }

        // Simpanan sukarela awal
        Simpanan::create([
            'anggota_id'    => $anggota2->id,
            'jenis_simpanan' => 'sukarela',
            'jumlah'        => 100000,
            'tanggal'       => $tanggalDaftar2,
        ]);
    }
}
