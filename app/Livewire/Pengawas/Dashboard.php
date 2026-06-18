<?php

namespace App\Livewire\Pengawas;

use App\Models\Anggota;
use App\Models\Cicilan;
use App\Models\Pinjaman;
use App\Models\Simpanan;
use App\Models\User;
use Illuminate\Support\Carbon;
use Livewire\Component;

class Dashboard extends Component
{
    protected $listeners = [
        'dataKoperasiUpdated' => '$refresh',
    ];
    public $transaksiTerbaru;
    public function render()
    {
        $simpanan = Simpanan::with('anggota')
            ->latest()
            ->get()
            ->map(function ($item) {

                return (object) [

                    'created_at' => $item->created_at,

                    'kode_anggota' =>
                    $item->anggota->kode_anggota ?? '-',

                    'nama_anggota' =>
                    $item->anggota->nama_anggota ?? '-',

                    'jenis' =>
                    'Simpanan ' .
                        ucfirst($item->jenis_simpanan),

                    'nominal' =>
                    $item->jumlah,

                    'status' =>
                    'Berhasil',
                ];
            });

        $cicilan = Cicilan::with('pinjaman.anggota')
            ->latest()
            ->get()
            ->map(function ($item) {

                return (object) [

                    'created_at' => $item->created_at,

                    'kode_anggota' =>
                    $item->pinjaman->anggota->kode_anggota ?? '-',

                    'nama_anggota' =>
                    $item->pinjaman->anggota->nama_anggota ?? '-',

                    'jenis' =>
                    'Cicilan',

                    'nominal' =>
                    $item->jumlah_tagihan,

                    'status' =>
                    ucfirst($item->status),
                ];
            });

        $pinjaman = Pinjaman::with('anggota')
            ->latest()
            ->get()
            ->map(function ($item) {

                return (object) [

                    'created_at' => $item->created_at,

                    'kode_anggota' =>
                    $item->anggota->kode_anggota ?? '-',

                    'nama_anggota' =>
                    $item->anggota->nama_anggota ?? '-',

                    'jenis' =>
                    'Pinjaman ' .
                        ucfirst($item->jenis_pinjaman),

                    'nominal' =>
                    $item->jumlah_pengajuan,

                    'status' =>
                    ucfirst($item->status),
                ];
            });

        $this->transaksiTerbaru =
            $simpanan
            ->merge($cicilan)
            ->merge($pinjaman)
            ->sortByDesc('created_at')
            ->take(10);

        $today = Carbon::today();

        $totalPinjaman = Pinjaman::where(
            'status',
            'aktif'
        )->sum('jumlah_pengajuan');

        $pinjamanBiasa = Pinjaman::where(
            'jenis_pinjaman',
            'biasa'
        )
            ->where(
                'status',
                'aktif'
            )
            ->sum('jumlah_pengajuan');

        $pinjamanKhusus = Pinjaman::where(
            'jenis_pinjaman',
            'khusus'
        )
            ->where(
                'status',
                'aktif'
            )
            ->sum('jumlah_pengajuan');

        $totalMasukHariIni =
            Simpanan::whereDate(
                'tanggal',
                $today
            )->sum('jumlah')

            +

            Cicilan::whereDate(
                'tanggal_bayar',
                $today
            )->sum('jumlah_tagihan');

        $totalKeluarHariIni =
            Pinjaman::whereDate(
                'tanggal_persetujuan',
                $today
            )
            ->where('status', 'aktif')
            ->sum('jumlah_pengajuan');

        $transaksiHariIni =
            $totalMasukHariIni +
            $totalKeluarHariIni;
        return view('livewire.pengawas.dashboard', [
            // ANGGOTA
            'total_anggota' => Anggota::count(),
            'anggota_disetujui' => User::where('role', 'anggota')
                ->where('status', 'disetujui')
                ->count(),
            'anggota_menunggu' => User::where('role', 'anggota')
                ->where('status', 'menunggu')
                ->count(),
            // SIMPANAN
            'total_simpanan' => Simpanan::sum('jumlah'),
            'simpanan_wajib' => Simpanan::where('jenis_simpanan', 'wajib')
                ->sum('jumlah'),
            'simpanan_pokok' => Simpanan::where('jenis_simpanan', 'pokok')
                ->sum('jumlah'),
            'simpanan_sukarela' => Simpanan::where('jenis_simpanan', 'sukarela')
                ->sum('jumlah'),

            'totalPinjaman' => $totalPinjaman,

            'pinjamanBiasa' => $pinjamanBiasa,

            'pinjamanKhusus' => $pinjamanKhusus,

            'totalMasukHariIni' => $totalMasukHariIni,

            'totalKeluarHariIni' => $totalKeluarHariIni,

            'transaksiHariIni' => $transaksiHariIni,
        ]);
    }
}
