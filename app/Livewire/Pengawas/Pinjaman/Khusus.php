<?php

namespace App\Livewire\Pengawas\Pinjaman;

use App\Models\Pinjaman;
use Livewire\Component;
use Livewire\WithPagination;

class Khusus extends Component
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
            ->where('jenis_pinjaman', 'khusus')
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
            'livewire.pengawas.pinjaman.khusus',
            [
                'title' => 'Pinjaman Khusus',
                'pinjaman' => $pinjaman,
                'totalPinjamanKhusus' => $totalPinjamanKhusus,
            ]
        );
    }
}
