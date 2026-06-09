<?php

namespace App\Livewire\Anggota;

use Livewire\Component;
use App\Models\Simpanan;

class Dashboard extends Component
{
    public function render()
    {
        $anggotaId = auth()->user()->anggota->id;

        /*
        |--------------------------------------------------------------------------
        | TOTAL SIMPANAN
        |--------------------------------------------------------------------------
        */

        $total_simpanan = Simpanan::where(
            'anggota_id',
            $anggotaId
        )->sum('jumlah');

        /*
        |--------------------------------------------------------------------------
        | SIMPANAN WAJIB
        |--------------------------------------------------------------------------
        */

        $simpanan_wajib = Simpanan::where(
            'anggota_id',
            $anggotaId
        )
            ->where(
                'jenis_simpanan',
                'wajib'
            )
            ->sum('jumlah');

        /*
        |--------------------------------------------------------------------------
        | SIMPANAN POKOK
        |--------------------------------------------------------------------------
        */

        $simpanan_pokok = Simpanan::where(
            'anggota_id',
            $anggotaId
        )
            ->where(
                'jenis_simpanan',
                'pokok'
            )
            ->sum('jumlah');

        /*
        |--------------------------------------------------------------------------
        | SIMPANAN SUKARELA
        |--------------------------------------------------------------------------
        */

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
        | TRANSAKSI TERBARU
        |--------------------------------------------------------------------------
        */

        $transaksi_terbaru = Simpanan::where(
            'anggota_id',
            $anggotaId
        )
            ->latest()
            ->take(5)
            ->get();

        return view(
            'livewire.anggota.dashboard',
            compact(
                'total_simpanan',
                'simpanan_wajib',
                'simpanan_pokok',
                'simpanan_sukarela',
                'transaksi_terbaru'
            )
        );
    }
}
