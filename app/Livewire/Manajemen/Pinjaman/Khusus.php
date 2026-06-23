<?php

namespace App\Livewire\Manajemen\Pinjaman;

use App\Models\Pinjaman;
use Livewire\Component;
use Livewire\WithPagination;

class Khusus extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public string $search       = '';
    public string $filterStatus = '';
    public int    $paginate     = 10;
    public string $sortBy       = 'created_at';
    public string $sortDir      = 'desc';

    public function updatingSearch(): void       { $this->resetPage(); }
    public function updatingFilterStatus(): void { $this->resetPage(); }
    public function updatingPaginate(): void     { $this->resetPage(); }

    public function render()
    {
        $pinjaman = Pinjaman::with('anggota')
            ->where('jenis_pinjaman', 'khusus')
            ->when($this->search, fn($q) => $q->whereHas('anggota',
                fn($aq) => $aq->where('nama_anggota', 'like', "%{$this->search}%")
                               ->orWhere('kode_anggota', 'like', "%{$this->search}%")
            )->orWhere('kode_pinjaman', 'like', "%{$this->search}%"))
            ->when($this->filterStatus, fn($q) => $q->where('status', $this->filterStatus))
            ->orderBy($this->sortBy, $this->sortDir)
            ->paginate($this->paginate);

        $totalPinjamanKhusus = Pinjaman::where('jenis_pinjaman', 'khusus')
            ->where('status', 'aktif')
            ->sum('jumlah_pengajuan');

        return view('livewire.manajemen.pinjaman.khusus', [
            'title'               => 'Pinjaman Khusus',
            'pinjaman'            => $pinjaman,
            'totalPinjamanKhusus' => $totalPinjamanKhusus,
        ]);
    }
}
