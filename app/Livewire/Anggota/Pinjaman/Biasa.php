<?php

namespace App\Livewire\Anggota\Pinjaman;

use App\Models\Pinjaman;
use Livewire\Component;

class Biasa extends Component
{
    protected $listeners = [
        'dataKoperasiUpdated' => '$refresh',
    ];
    public $search = '';
    public $paginate = 10;
    public $sortBy = 'created_at';
    public $sortDirection = 'desc';
    public function updatingSearch()
    {
        $this->resetPage();
    }
    public function render()
    {
        $anggota = auth()->user()->anggota;
        $pinjaman = Pinjaman::with('anggota')
            ->where(
                'anggota_id',
                $anggota->id
            )
            ->where(
                'jenis_pinjaman',
                'biasa'
            )
            ->when($this->search, function ($query) {
                $query->where(
                    'kode_pinjaman',
                    'like',
                    '%' . $this->search . '%'
                );
            })
            ->orderBy(
                $this->sortBy,
                $this->sortDirection
            )
            ->paginate($this->paginate);
        $totalPinjamanBiasa = Pinjaman::where(
            'anggota_id',
            $anggota->id
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
        return view(
            'livewire.anggota.pinjaman.biasa',
            [
                'title' => 'Pinjaman Biasa',
                'pinjaman' => $pinjaman,
                'totalPinjamanBiasa' => $totalPinjamanBiasa,
            ]
        );
    }
}
