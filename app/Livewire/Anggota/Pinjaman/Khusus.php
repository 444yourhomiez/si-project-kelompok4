<?php

namespace App\Livewire\Anggota\Pinjaman;

use App\Models\Pinjaman;
use Livewire\Component;
use Livewire\WithPagination;

class Khusus extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    protected $listeners = [
        'dataKoperasiUpdated' => '$refresh',
    ];
    public $search = '';
    public $paginate = 10;
    public $sortBy = 'created_at';
    public $sortDirection = 'desc';
    public $filterStatus = '';

    public function updatingSearch() { $this->resetPage(); }
    public function updatingFilterStatus() { $this->resetPage(); }

    public function render()
    {
        $anggota = auth()->user()->anggota;
        $pinjaman = Pinjaman::with('anggota')
            ->where('anggota_id', $anggota->id)
            ->where('jenis_pinjaman', 'khusus')
            ->when($this->search, fn($q) => $q->where('kode_pinjaman', 'like', '%'.$this->search.'%'))
            ->when($this->filterStatus, fn($q) => $q->where('status', $this->filterStatus))
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate($this->paginate);
        $totalPinjamanKhusus = Pinjaman::where(
            'anggota_id',
            $anggota->id
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
        return view(
            'livewire.anggota.pinjaman.khusus',
            [
                'title' => 'Pinjaman Khusus',
                'pinjaman' => $pinjaman,
                'totalPinjamanKhusus' => $totalPinjamanKhusus,
            ]
        );
    }
}
