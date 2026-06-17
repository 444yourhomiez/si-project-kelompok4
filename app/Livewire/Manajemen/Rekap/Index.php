<?php

namespace App\Livewire\Manajemen\Rekap;

use App\Models\Cicilan;
use App\Models\Pinjaman;
use App\Models\Simpanan;
use Carbon\Carbon;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        $today = Carbon::today();

        $totalMasuk =
            Simpanan::whereDate('tanggal', $today)
            ->sum('jumlah')

            +

            Cicilan::whereDate(
                'tanggal_bayar',
                $today
            )->sum('jumlah_tagihan');

        $totalKeluar =
            Pinjaman::whereDate(
                'tanggal_persetujuan',
                $today
            )
            ->where('status', 'aktif')
            ->sum('jumlah_pengajuan');

        $saldo =
            $totalMasuk - $totalKeluar;

        $simpanan = Simpanan::with('anggota')
            ->whereDate('tanggal', $today)
            ->get()
            ->map(function ($item) {

                return [

                    'tanggal' => $item->tanggal,

                    'kode_anggota' =>
                    $item->anggota->kode_anggota,

                    'nama_anggota' =>
                    $item->anggota->nama_anggota,

                    'jenis' =>
                    'Simpanan ' .
                        ucfirst($item->jenis_simpanan),

                    'masuk' =>
                    $item->jumlah,

                    'keluar' => 0,

                ];
            });

        $cicilan = Cicilan::with(
            'pinjaman.anggota'
        )
            ->whereDate(
                'tanggal_bayar',
                $today
            )
            ->get()
            ->map(function ($item) {

                return [

                    'tanggal' =>
                    $item->tanggal_bayar,

                    'kode_anggota' =>
                    $item->pinjaman
                        ->anggota
                        ->kode_anggota,

                    'nama_anggota' =>
                    $item->pinjaman
                        ->anggota
                        ->nama_anggota,

                    'jenis' =>
                    'Cicilan',

                    'masuk' =>
                    $item->jumlah_tagihan,

                    'keluar' => 0,

                ];
            });

        $pinjaman = Pinjaman::with('anggota')
            ->whereDate(
                'tanggal_persetujuan',
                $today
            )
            ->where('status', 'aktif')
            ->get()
            ->map(function ($item) {

                return [

                    'tanggal' =>
                    $item->tanggal_persetujuan,

                    'kode_anggota' =>
                    $item->anggota->kode_anggota,

                    'nama_anggota' =>
                    $item->anggota->nama_anggota,

                    'jenis' =>
                    'Pinjaman ' .
                        ucfirst($item->jenis_pinjaman),

                    'masuk' => 0,

                    'keluar' =>
                    $item->jumlah_pengajuan,

                ];
            });

        $riwayat = $simpanan
            ->merge($cicilan)
            ->merge($pinjaman)
            ->sortByDesc('tanggal')
            ->values();

        return view(
            'livewire.manajemen.rekap.index',
            [

                'title' => 'Rekapitulasi Harian',

                'totalMasuk' => $totalMasuk,

                'totalKeluar' => $totalKeluar,

                'saldo' => $saldo,

                'riwayat' => $riwayat,
            ]
        );
    }
}
