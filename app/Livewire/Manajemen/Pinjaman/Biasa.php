<?php

namespace App\Livewire\Manajemen\Pinjaman;

use App\Models\Pinjaman;
use Livewire\Component;
use Livewire\WithPagination;

class Biasa extends Component
{
    use WithPagination;
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
            ->where('jenis_pinjaman', 'biasa')
            ->when($this->search, function ($query) {
                $query->whereHas('anggota', function ($q) {
                    $q->where(
                        'nama_anggota',
                        'like',
                        '%' . $this->search . '%'
                    );
                });
            })
            ->orderBy(
                $this->sortBy,
                $this->sortDirection
            )
            ->paginate($this->paginate);
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
        return view(
            'livewire.manajemen.pinjaman.biasa',
            [
                'title' => 'Pinjaman Biasa',
                'pinjaman' => $pinjaman,
                'totalPinjamanBiasa' => $totalPinjamanBiasa,
            ]
        );
    }
}
