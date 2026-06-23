<?php

namespace App\Livewire\Manajemen\Pinjaman;

use App\Models\Pinjaman;
use Livewire\Component;
use Livewire\WithPagination;

class Biasa extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['dataKoperasiUpdated' => '$refresh'];

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
            ->where('jenis_pinjaman', 'biasa')
            ->when($this->search, fn($q) => $q->whereHas('anggota',
                fn($aq) => $aq->where('nama_anggota', 'like', "%{$this->search}%")
                               ->orWhere('kode_anggota', 'like', "%{$this->search}%")
            )->orWhere('kode_pinjaman', 'like', "%{$this->search}%"))
            ->when($this->filterStatus, fn($q) => $q->where('status', $this->filterStatus))
            ->orderBy($this->sortBy, $this->sortDir)
            ->paginate($this->paginate);

        $totalPinjamanBiasa = Pinjaman::where('jenis_pinjaman', 'biasa')
            ->where('status', 'aktif')
            ->sum('jumlah_pengajuan');

        return view('livewire.manajemen.pinjaman.biasa', [
            'title'             => 'Pinjaman Biasa',
            'pinjaman'          => $pinjaman,
            'totalPinjamanBiasa' => $totalPinjamanBiasa,
        ]);
    }
}
