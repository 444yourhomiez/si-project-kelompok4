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

        for ($i = 1; $i <= 100; $i++) {

            // Status anggota
            if ($i <= 75) {
                $status = 'disetujui';
            } elseif ($i <= 90) {
                $status = 'menunggu';
            } else {
                $status = 'ditolak';
            }

            // Lama keanggotaan hanya untuk yang disetujui
            $bulan = rand(1, 24);

            $user = User::create([
                'nama_user' => 'Anggota Test ' . $i,
                'email'     => "anggota{$i}@gmail.com",
                'password'  => Hash::make('password'),
                'role'      => 'anggota',
                'status'    => $status,
            ]);

            $tanggalDaftar = now()->subMonths($bulan);

            $anggota = Anggota::create([
                'user_id'             => $user->id,
                'jadwal_id'           => $jadwalId,
                'kode_anggota'        => 'A-' . str_pad($i, 6, '0', STR_PAD_LEFT),
                'nama_anggota'        => 'Anggota Test ' . $i,
                'no_ktp'              => '320100' . str_pad($i, 10, '0', STR_PAD_LEFT),
                'no_hp'               => '08' . rand(1111111111, 9999999999),
                'alamat'              => 'Bandung',
                'tempat_lahir'        => 'Bandung',
                'tanggal_lahir'       => now()->subYears(rand(20, 50))->format('Y-m-d'),
                'jenis_kelamin'       => rand(0, 1) ? 'Laki-laki' : 'Perempuan',
                'agama'               => 'Islam',
                'nama_ibu_kandung'    => 'Ibu Test ' . $i,
                'nama_ahli_waris'     => 'Ahli Waris ' . $i,
                'hubungan_ahli_waris' => 'Orang Tua',
                'status_rumah'        => 'Milik Sendiri',
                'penghasilan'         => collect([
                    'Kurang dari Rp 1.000.000',
                    'Rp 1.000.000 - Rp 2.000.000',
                    'Rp 2.000.000 - Rp. 3.000.000',
                    'Rp 3.000.000 - Rp. 5.000.000',
                    'Diatas Rp 5.000.000',
                ])->random(),
                'tanggal_daftar'      => $tanggalDaftar,
            ]);

            // Simpanan hanya untuk anggota yang disetujui
            if ($status === 'disetujui') {

                // Simpanan Pokok
                Simpanan::create([
                    'anggota_id'       => $anggota->id,
                    'jenis_simpanan'   => 'pokok',
                    'jumlah'           => 500000,
                    'tanggal'          => $tanggalDaftar,
                ]);

                // Simpanan Wajib Bulanan
                for ($j = $bulan; $j >= 1; $j--) {
                    Simpanan::create([
                        'anggota_id'       => $anggota->id,
                        'jenis_simpanan'   => 'wajib',
                        'jumlah'           => 50000,
                        'tanggal'          => now()->subMonths($j),
                    ]);
                }

                // Simpanan Sukarela
                Simpanan::create([
                    'anggota_id'       => $anggota->id,
                    'jenis_simpanan'   => 'sukarela',
                    'jumlah'           => 100000,
                    'tanggal'          => $tanggalDaftar,
                ]);
            }
        }
    }
}