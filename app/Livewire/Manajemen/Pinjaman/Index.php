<?php

namespace App\Livewire\Manajemen\Pinjaman;

use App\Models\Pinjaman;
use Livewire\Component;

class Index extends Component
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
        $pinjaman = Pinjaman::with('anggota')
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
        $totalPinjaman =
            Pinjaman::where(
                'status',
                'aktif'
            )->sum('jumlah_pengajuan');

        $totalPinjamanBiasa =
            Pinjaman::where(
                'jenis_pinjaman',
                'biasa'
            )
            ->where(
                'status',
                'aktif'
            )
            ->sum('jumlah_pengajuan');

        $totalPinjamanKhusus =
            Pinjaman::where(
                'jenis_pinjaman',
                'khusus'
            )
            ->where(
                'status',
                'aktif'
            )
            ->sum('jumlah_pengajuan');
        return view(
            'livewire.manajemen.pinjaman.index',
            [
                'title' => 'Daftar Pinjaman',
                'pinjaman' => $pinjaman,
                'totalPinjaman' => $totalPinjaman,
                'totalPinjamanBiasa' => $totalPinjamanBiasa,
                'totalPinjamanKhusus' => $totalPinjamanKhusus,
            ]
        );
    }
}
