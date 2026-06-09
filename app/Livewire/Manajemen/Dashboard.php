<?php

namespace App\Livewire\Manajemen;

use App\Models\Anggota;
use App\Models\Simpanan;
use App\Models\User;
use Livewire\Component;

class Dashboard extends Component
{
    protected $listeners = [

        'dataKoperasiUpdated' => '$refresh'

    ];
    
    public $transaksiTerbaru;

    public function render()
    {
        $this->transaksiTerbaru = Simpanan::with('anggota')
            ->latest()
            ->take(10)
            ->get();


        return view('livewire.manajemen.dashboard', [

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

        ]);
    }
}
