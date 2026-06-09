<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Anggota;
use App\Models\JadwalWawancara;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        $jadwalIds = JadwalWawancara::pluck('id')->toArray();

        $kodeCounter = 1;

        for ($i = 1; $i <= 100; $i++) {

            // STATUS USER
            $status = $faker->randomElement([
                'disetujui',
                'menunggu',
            ]);

            // JENIS KELAMIN
            $jk = $faker->randomElement([
                'Laki-laki',
                'Perempuan'
            ]);

            $nama = $faker->name;

            // USER
            $user = User::create([

                'nama_user' => $nama,

                // SESUAI VALIDASI GMAIL
                'email' => 'anggota' . $i . '@gmail.com',

                'password' => Hash::make('password'),

                'role' => 'anggota',

                'status' => $status,

            ]);

            // STATUS MENIKAH
            $menikah = rand(0, 1);

            // AHLI WARIS
            $hubunganAhliWaris = $faker->randomElement([
                'Ayah',
                'Ibu',
                'Suami',
                'Istri',
                'Anak',
                'Saudara Kandung',
                'Kakek',
                'Nenek',
                'Paman',
                'Bibi',
                'Lainnya'
            ]);

            // ANGGOTA
            Anggota::create([

                'user_id' => $user->id,

                'jadwal_id' => $faker->randomElement($jadwalIds),

                'kode_anggota' => $status == 'disetujui'

                    ? 'A-' . str_pad($kodeCounter++, 6, '0', STR_PAD_LEFT)

                    : null,

                // DATA UTAMA
                'nama_anggota' => $nama,

                'no_ktp' => $faker->unique()
                    ->numerify('################'),

                // NO HP UNIQUE & CLEAN
                'no_hp' => '08' . $faker->unique()
                    ->numerify('##########'),

                'alamat' => $faker->address,

                'tempat_lahir' => $faker->city,

                // MINIMAL UMUR 17 TAHUN
                'tanggal_lahir' => $faker->dateTimeBetween(
                    '-50 years',
                    '-17 years'
                )->format('Y-m-d'),

                'jenis_kelamin' => $jk,

                'agama' => $faker->randomElement([
                    'Islam',
                    'Kristen',
                    'Katolik',
                    'Hindu',
                    'Buddha',
                    'Konghucu',
                    'Lainnya'
                ]),

                'nama_ibu_kandung' => $faker->name,

                // DATA TAMBAHAN
                'tanggal_kawin' => $menikah
                    ? $faker->date()
                    : null,

                'nama_pasangan' => $menikah
                    ? $faker->name
                    : null,

                'nama_ahli_waris' => $faker->name,

                'hubungan_ahli_waris' => $hubunganAhliWaris,

                'status_rumah' => $faker->randomElement([
                    'Milik Sendiri',
                    'Milik Keluarga',
                    'Milik Perusahaan',
                    'Sewa'
                ]),

                'penghasilan' => $faker->randomElement([
                    'Dibawah Rp 500.000',
                    'Rp 500.000 - Rp. 1.000.000',
                    'Rp 1.000.000 - Rp. 2.000.000',
                    'Rp 2.000.000 - Rp. 3.000.000',
                    'Rp 3.000.000 - Rp. 4.000.000',
                    'Rp 4.000.000 - Rp. 5.000.000',
                    'Diatas Rp 5.000.000',
                ]),

                'tanggal_daftar' => now(),

            ]);
        }
    }
}
