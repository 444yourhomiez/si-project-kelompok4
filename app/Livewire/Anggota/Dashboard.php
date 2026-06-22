<?php

namespace App\Livewire\Anggota;

use App\Models\Simpanan;
use App\Models\Pinjaman;
use App\Models\Cicilan;
use Livewire\Component;

class Dashboard extends Component
{
    protected $listeners = [
        'dataKoperasiUpdated' => '$refresh',
    ];

    public function render()
    {
        $anggotaId = auth()->user()->anggota->id;

        /*
        |--------------------------------------------------------------------------
        | SIMPANAN
        |--------------------------------------------------------------------------
        */

        $total_simpanan = Simpanan::where(
            'anggota_id',
            $anggotaId
        )->sum('jumlah');

        $simpanan_wajib = Simpanan::where(
            'anggota_id',
            $anggotaId
        )
            ->where(
                'jenis_simpanan',
                'wajib'
            )
            ->sum('jumlah');

        $simpanan_pokok = Simpanan::where(
            'anggota_id',
            $anggotaId
        )
            ->where(
                'jenis_simpanan',
                'pokok'
            )
            ->sum('jumlah');

        $simpanan_sukarela = Simpanan::where(
            'anggota_id',
            $anggotaId
        )
            ->where(
                'jenis_simpanan',
                'sukarela'
            )
            ->sum('jumlah');

        /*
        |--------------------------------------------------------------------------
        | PINJAMAN
        |--------------------------------------------------------------------------
        */

        $total_pinjaman = Pinjaman::where(
            'anggota_id',
            $anggotaId
        )
            ->where(
                'status',
                'aktif'
            )
            ->sum('jumlah_pengajuan');

        $pinjaman_biasa = Pinjaman::where(
            'anggota_id',
            $anggotaId
        )
            ->where(
                'jenis_pinjaman',
                'biasa'
            )
            ->where(
                'status',
                'aktif'
            )
            ->sum('jumlah_pengajuan');

        $pinjaman_khusus = Pinjaman::where(
            'anggota_id',
            $anggotaId
        )
            ->where(
                'jenis_pinjaman',
                'khusus'
            )
            ->where(
                'status',
                'aktif'
            )
            ->sum('jumlah_pengajuan');

        /*
        |--------------------------------------------------------------------------
        | CICILAN
        |--------------------------------------------------------------------------
        */

        $total_cicilan = Cicilan::whereHas(
            'pinjaman',
            function ($query) use ($anggotaId) {
                $query->where(
                    'anggota_id',
                    $anggotaId
                );
            }
        )->sum('jumlah_tagihan');

        $totalBelumBayar = Cicilan::whereHas(
            'pinjaman',
            function ($query) use ($anggotaId) {
                $query->where(
                    'anggota_id',
                    $anggotaId
                );
            }
        )
            ->where(
                'status',
                'belum'
            )
            ->sum('jumlah_tagihan');

        $totalLunas = Cicilan::whereHas(
            'pinjaman',
            function ($query) use ($anggotaId) {
                $query->where(
                    'anggota_id',
                    $anggotaId
                );
            }
        )
            ->where(
                'status',
                'lunas'
            )
            ->sum('jumlah_tagihan');

        /*
        |--------------------------------------------------------------------------
        | TRANSAKSI TERBARU
        |--------------------------------------------------------------------------
        */

        $transaksiSimpanan = Simpanan::where(
            'anggota_id',
            $anggotaId
        )
            ->latest()
            ->take(10)
            ->get()
            ->map(function ($item) {

                return [

                    'tanggal' => $item->created_at,

                    'jenis' => 'Simpanan ' . ucfirst($item->jenis_simpanan),

                    'status' => 'Tersimpan',

                    'nominal' => $item->jumlah,

                ];
            });

        $transaksiPinjaman = Pinjaman::where(
            'anggota_id',
            $anggotaId
        )
            ->latest()
            ->take(10)
            ->get()
            ->map(function ($item) {

                return [

                    'tanggal' => $item->created_at,

                    'jenis' => 'Pinjaman ' . ucfirst($item->jenis_pinjaman),

                    'status' => ucfirst($item->status),

                    'nominal' => $item->jumlah_pengajuan,

                ];
            });

        $transaksiCicilan = Cicilan::whereHas(
            'pinjaman',
            function ($query) use ($anggotaId) {

                $query->where(
                    'anggota_id',
                    $anggotaId
                );
            }
        )
            ->latest()
            ->take(10)
            ->get()
            ->map(function ($item) {

                return [

                    'tanggal' => $item->created_at,

                    'jenis' => 'Cicilan',

                    'status' => ucfirst($item->status),

                    'nominal' => $item->jumlah_tagihan,

                ];
            });

        $transaksi_terbaru = collect()
            ->merge($transaksiSimpanan)
            ->merge($transaksiPinjaman)
            ->merge($transaksiCicilan)
            ->sortByDesc('tanggal')
            ->take(10);

        return view(
            'livewire.anggota.dashboard',
            compact(
                'total_simpanan',
                'simpanan_wajib',
                'simpanan_pokok',
                'simpanan_sukarela',

                'total_pinjaman',
                'pinjaman_biasa',
                'pinjaman_khusus',

                'total_cicilan',
                'totalBelumBayar',
                'totalLunas',

                'transaksi_terbaru'
            )
        );
    }
}
