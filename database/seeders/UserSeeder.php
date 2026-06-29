<?php

namespace Database\Seeders;

use App\Models\Anggota;
use App\Models\Cicilan;
use App\Models\JadwalWawancara;
use App\Models\Pinjaman;
use App\Models\RekapHarian;
use App\Models\Simpanan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $jadwalId    = JadwalWawancara::first()?->id;
        $manajemenId = User::where('role', 'manajemen')->first()?->id;

        // ── Data enum sesuai migration ───────────────────────────────────────
        $namaDepan = [
            'Agus','Budi','Citra','Dedi','Eka','Farida','Guntur','Hana',
            'Irwan','Julia','Kurnia','Lena','Maman','Nina','Oki','Putri',
            'Rahmat','Sari','Tono','Umi','Vina','Wahyu','Yanto','Zahra',
            'Andi','Bayu','Cahya','Dian','Endang','Fitri','Galih','Hendra',
            'Indra','Joko','Kiki','Linda','Mira','Nani','Pandi','Rini',
            'Sinta','Tari','Udin','Vita','Winda','Yuli','Asep','Dadan',
            'Euis','Gina',
        ];
        $namaBelakang = [
            'Santoso','Wijaya','Susanto','Kusuma','Rahayu','Permana',
            'Hidayat','Nugraha','Saputra','Wibowo','Pratama','Utama',
            'Firmansyah','Setiawan','Gunawan','Kurniawan','Putra','Sari',
            'Lestari','Maharani','Dewi','Aprilia','Cahyani','Puspita',
            'Hartono','Supriyadi','Wahyudi','Budiman','Suryadi','Mulyana',
        ];
        $kota              = ['Bandung','Jakarta','Surabaya','Yogyakarta','Semarang','Bekasi','Depok','Tangerang','Bogor','Malang','Cimahi','Garut'];
        $agama             = ['Islam','Kristen','Katolik','Hindu','Buddha','Konghucu'];
        $statusRumah       = ['Milik Sendiri','Milik Keluarga','Milik Perusahaan','Sewa'];
        $hubunganAhliWaris = ['Ayah','Ibu','Suami','Istri','Anak','Saudara Kandung'];
        $penghasilan       = [
            'Dibawah Rp 500.000',
            'Rp 500.000 - Rp. 1.000.000',
            'Rp 1.000.000 - Rp. 2.000.000',
            'Rp 2.000.000 - Rp. 3.000.000',
            'Rp 3.000.000 - Rp. 4.000.000',
            'Rp 4.000.000 - Rp. 5.000.000',
            'Diatas Rp 5.000.000',
        ];
        $tujuanPinjaman = [
            'Modal usaha','Renovasi rumah','Biaya pendidikan',
            'Kebutuhan konsumtif','Biaya kesehatan','Investasi usaha',
        ];
        $jaminanList     = ['BPKB Motor','BPKB Mobil','Sertifikat Tanah','SK Kerja'];
        $nominalPinjaman = [1_000_000, 2_000_000, 3_000_000, 5_000_000, 7_500_000, 10_000_000, 15_000_000];
        $tenorList       = [6, 12, 18, 24];

        // ── Distribusi 150 anggota ──────────────────────────────────────────
        // i   1 –  15 : disetujui + pinjaman PENDING
        // i  16 –  35 : disetujui + pinjaman LUNAS
        // i  36 –  95 : disetujui + pinjaman AKTIF
        // i  96 – 120 : disetujui + tanpa pinjaman
        // i 121 – 150 : menunggu
        // ────────────────────────────────────────────────────────────────────

        for ($i = 1; $i <= 150; $i++) {

            $status = $i <= 120 ? 'disetujui' : 'menunggu';

            $namaD = $namaDepan[($i - 1) % count($namaDepan)];
            $namaB = $namaBelakang[($i - 1) % count($namaBelakang)];
            $nama  = $namaD . ' ' . $namaB;
            $kj    = $i % 3 === 0 ? 'Perempuan' : 'Laki-laki';

            // Tanggal daftar random di rentang 2023–2025
            if ($status === 'disetujui') {
                $tahunDaftar   = rand(2023, 2025);
                $bulanDaftar   = rand(1, 12);
                $tanggalDaftar = Carbon::create($tahunDaftar, $bulanDaftar, rand(1, 20));

                // Hitung berapa bulan dari tanggal daftar sampai sekarang
                $bulanKeanggotaan = (int) $tanggalDaftar->diffInMonths(now());
                $bulanKeanggotaan = max($bulanKeanggotaan, 1);
            } else {
                $tanggalDaftar    = now()->subDays(rand(1, 30));
                $bulanKeanggotaan = 0;
            }

            // ── User ────────────────────────────────────────────────────────
            $user = User::create([
                'nama_user' => $nama,
                'email'     => "anggota{$i}@gmail.com",
                'password'  => Hash::make('password'),
                'role'      => 'anggota',
                'status'    => $status,
            ]);

            // ── Anggota ─────────────────────────────────────────────────────
            $kotaItem = $kota[$i % count($kota)];
            $anggota  = Anggota::create([
                'user_id'             => $user->id,
                'jadwal_id'           => $jadwalId,
                'kode_anggota'        => $status === 'disetujui' ? 'A-' . str_pad($i, 6, '0', STR_PAD_LEFT) : null,
                'nama_anggota'        => $nama,
                'no_ktp'              => '320100' . str_pad($i, 10, '0', STR_PAD_LEFT),
                'no_hp'               => '08' . rand(100_000_000, 999_999_999),
                'alamat'              => 'Jl. ' . $namaB . ' No. ' . rand(1, 99) . ', ' . $kotaItem,
                'tempat_lahir'        => $kotaItem,
                'tanggal_lahir'       => now()->subYears(rand(22, 55))->subDays(rand(0, 364))->format('Y-m-d'),
                'jenis_kelamin'       => $kj,
                'agama'               => $agama[$i % count($agama)],
                'nama_ibu_kandung'    => 'Ibu ' . $namaBelakang[$i % count($namaBelakang)],
                'nama_ahli_waris'     => $namaDepan[($i + 1) % count($namaDepan)] . ' ' . $namaB,
                'hubungan_ahli_waris' => $hubunganAhliWaris[$i % count($hubunganAhliWaris)],
                'status_rumah'        => $statusRumah[$i % count($statusRumah)],
                'penghasilan'         => $penghasilan[$i % count($penghasilan)],
                'tanggal_daftar'      => $tanggalDaftar->format('Y-m-d'),
            ]);

            if ($status !== 'disetujui') continue;

            // ── Simpanan Pokok (sekali saat mendaftar — Rp 500.000) ─────────
            Simpanan::create([
                'anggota_id'     => $anggota->id,
                'jenis_simpanan' => 'pokok',
                'jumlah'         => 500_000,
                'tanggal'        => $tanggalDaftar->format('Y-m-d'),
            ]);
            $this->rekap($manajemenId, 'uang_masuk', 500_000, "Simpanan Pokok - {$nama}", $tanggalDaftar->format('Y-m-d'));

            // ── Simpanan Wajib (tiap bulan — Rp 50.000) ────────────────────
            for ($j = $bulanKeanggotaan; $j >= 0; $j--) {
                $tgl = $tanggalDaftar->copy()->addMonths($bulanKeanggotaan - $j)->startOfMonth();
                Simpanan::create([
                    'anggota_id'     => $anggota->id,
                    'jenis_simpanan' => 'wajib',
                    'jumlah'         => 50_000,
                    'tanggal'        => $tgl->format('Y-m-d'),
                ]);
                $this->rekap($manajemenId, 'uang_masuk', 50_000, "Simpanan Wajib - {$nama}", $tgl->format('Y-m-d'));
            }

            // ── Simpanan Sukarela (beberapa kali acak — Rp 100.000) ────────
            $jumlahSukarela = rand(1, 5);
            for ($j = 0; $j < $jumlahSukarela; $j++) {
                $offsetBulan = rand(0, $bulanKeanggotaan);
                $tglSukarela = $tanggalDaftar->copy()->addMonths($offsetBulan)->format('Y-m-d');
                Simpanan::create([
                    'anggota_id'     => $anggota->id,
                    'jenis_simpanan' => 'sukarela',
                    'jumlah'         => 100_000,
                    'tanggal'        => $tglSukarela,
                ]);
                $this->rekap($manajemenId, 'uang_masuk', 100_000, "Simpanan Sukarela - {$nama}", $tglSukarela);
            }

            // Anggota i 96–120 tidak punya pinjaman
            if ($i > 95) continue;

            // ── Pinjaman ────────────────────────────────────────────────────
            $jumlah        = $nominalPinjaman[$i % count($nominalPinjaman)];
            $tenor         = $tenorList[$i % count($tenorList)];
            $jenisPinjaman = $i <= 55 ? 'biasa' : 'khusus';
            $bunga         = $jenisPinjaman === 'biasa' ? 0.6 : 1.2;  // jasa: biasa 0.6%, khusus 1.2%
            $bungaPerBulan = (int) round($jumlah * ($bunga / 100));   // jumlah × jasa% (flat, tetap tiap bulan)
            $pokokPerBulan = (int) round($jumlah / $tenor);
            $cicilan       = $pokokPerBulan + $bungaPerBulan;
            $totalBayar    = $cicilan * $tenor;
            $provisi       = (int) round($jumlah * 0.015);  // 1.5%
            $kapitalisasi  = (int) round($jumlah * 0.01);   // 1%
            $danaPerl      = (int) round($jumlah * 0.02);   // 2%
            $danaDiterima  = $jumlah - $provisi - $kapitalisasi - $danaPerl;
            $totalSimpanan = ($bulanKeanggotaan + 1) * 50_000 + 500_000;

            if ($i <= 15) {
                // PENDING — baru diajukan
                $tanggalPengajuan   = now()->subDays(rand(1, 10));
                $tanggalPersetujuan = null;
                $statusPinjaman     = 'pending';

            } elseif ($i <= 35) {
                // LUNAS — sudah selesai dilunasi
                $tanggalPengajuan   = $tanggalDaftar->copy()->addMonths(rand(1, 3));
                $tanggalPersetujuan = $tanggalPengajuan->copy()->addDays(rand(3, 7));
                $statusPinjaman     = 'lunas';

            } else {
                // AKTIF — sedang berjalan
                $bulanBerjalan      = rand(1, max(1, $tenor - 1));
                $tanggalPengajuan   = now()->subMonths($bulanBerjalan + rand(1, 2));
                $tanggalPersetujuan = $tanggalPengajuan->copy()->addDays(rand(3, 7));
                $statusPinjaman     = 'aktif';
            }

            $pinjaman = Pinjaman::create([
                'anggota_id'          => $anggota->id,
                'jenis_pinjaman'      => $jenisPinjaman,
                'jumlah_pengajuan'    => $jumlah,
                'jumlah_disetujui'    => $statusPinjaman !== 'pending' ? $jumlah : null,
                'total_simpanan'      => $totalSimpanan,
                'bunga'               => $bunga,
                'provisi'             => $provisi,
                'kapitalisasi'        => $kapitalisasi,
                'dana_perlindungan'   => $danaPerl,
                'dana_diterima'       => $danaDiterima,
                'tenor'               => $tenor,
                'cicilan_per_bulan'   => $cicilan,
                'total_pembayaran'    => $totalBayar,
                'tujuan_pinjaman'     => $tujuanPinjaman[$i % count($tujuanPinjaman)],
                'jaminan'             => $jaminanList[$i % count($jaminanList)],
                'status'              => $statusPinjaman,
                'tanggal_pengajuan'   => $tanggalPengajuan->format('Y-m-d'),
                'tanggal_persetujuan' => $tanggalPersetujuan?->format('Y-m-d'),
            ]);

            // Kapitalisasi → simpanan sukarela + rekap
            if ($statusPinjaman !== 'pending') {
                Simpanan::create([
                    'anggota_id'     => $anggota->id,
                    'jenis_simpanan' => 'sukarela',
                    'jumlah'         => $kapitalisasi,
                    'tanggal'        => $tanggalPersetujuan->format('Y-m-d'),
                ]);
                $this->rekap(
                    $manajemenId,
                    'uang_masuk',
                    $kapitalisasi,
                    "Kapitalisasi Pinjaman {$pinjaman->kode_pinjaman} - {$nama}",
                    $tanggalPersetujuan->format('Y-m-d')
                );

                // Rekap pencairan pinjaman (uang keluar ke anggota)
                $this->rekap(
                    $manajemenId,
                    'uang_keluar',
                    $danaDiterima,
                    "Pencairan Pinjaman {$pinjaman->kode_pinjaman} - {$nama}",
                    $tanggalPersetujuan->format('Y-m-d')
                );
            }

            if ($statusPinjaman === 'pending') continue;

            // ── Cicilan ─────────────────────────────────────────────────────
            $mulaiCicilan = $tanggalPersetujuan->copy()->addMonth()->startOfMonth();

            for ($k = 1; $k <= $tenor; $k++) {
                $jatuhTempo = $mulaiCicilan->copy()->addMonths($k - 1);

                if ($statusPinjaman === 'lunas') {
                    $statusCicilan = 'lunas';
                    $tanggalBayar  = $jatuhTempo->copy()->subDays(rand(0, 5))->format('Y-m-d');
                } else {
                    if ($jatuhTempo->isPast()) {
                        $statusCicilan = 'lunas';
                        $tanggalBayar  = $jatuhTempo->copy()->subDays(rand(0, 5))->format('Y-m-d');
                    } else {
                        $statusCicilan = 'belum';
                        $tanggalBayar  = null;
                    }
                }

                Cicilan::create([
                    'pinjaman_id'    => $pinjaman->id,
                    'cicilan_ke'     => $k,
                    'jumlah_tagihan' => $cicilan,
                    'jatuh_tempo'    => $jatuhTempo->format('Y-m-d'),
                    'tanggal_bayar'  => $tanggalBayar,
                    'status'         => $statusCicilan,
                ]);

                // Rekap pembayaran cicilan yang sudah lunas
                if ($statusCicilan === 'lunas' && $tanggalBayar) {
                    $this->rekap(
                        $manajemenId,
                        'uang_masuk',
                        $cicilan,
                        "Cicilan ke-{$k} {$pinjaman->kode_pinjaman} - {$nama}",
                        $tanggalBayar
                    );
                }
            }
        }
    }

    private function rekap(?int $userId, string $jenis, int $nominal, string $keterangan, string $tanggal): void
    {
        if (!$userId) return;

        RekapHarian::create([
            'user_id'    => $userId,
            'jenis'      => $jenis,
            'nominal'    => $nominal,
            'keterangan' => $keterangan,
            'tanggal'    => $tanggal,
        ]);
    }
}
