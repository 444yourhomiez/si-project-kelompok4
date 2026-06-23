<?php

namespace App\Livewire\Pengawas\Pinjaman;

use App\Models\Pinjaman;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public string $search       = '';
    public string $filterJenis  = '';
    public string $filterStatus = '';
    public int    $paginate     = 10;
    public string $sortBy       = 'created_at';
    public string $sortDir      = 'desc';

    public function updatingSearch(): void       { $this->resetPage(); }
    public function updatingFilterJenis(): void  { $this->resetPage(); }
    public function updatingFilterStatus(): void { $this->resetPage(); }
    public function updatingPaginate(): void     { $this->resetPage(); }

    public function render()
    {
        $pinjaman = Pinjaman::with('anggota')
            ->when($this->search, fn($q) => $q->whereHas('anggota',
                fn($aq) => $aq->where('nama_anggota', 'like', "%{$this->search}%")
                               ->orWhere('kode_anggota', 'like', "%{$this->search}%")
            )->orWhere('kode_pinjaman', 'like', "%{$this->search}%"))
            ->when($this->filterJenis,  fn($q) => $q->where('jenis_pinjaman', $this->filterJenis))
            ->when($this->filterStatus, fn($q) => $q->where('status', $this->filterStatus))
            ->orderBy($this->sortBy, $this->sortDir)
            ->paginate($this->paginate);

        $totalPinjaman       = Pinjaman::where('status', 'aktif')->sum('jumlah_pengajuan');
        $totalPinjamanBiasa  = Pinjaman::where('jenis_pinjaman', 'biasa')->where('status', 'aktif')->sum('jumlah_pengajuan');
        $totalPinjamanKhusus = Pinjaman::where('jenis_pinjaman', 'khusus')->where('status', 'aktif')->sum('jumlah_pengajuan');

        return view('livewire.pengawas.pinjaman.index', [
            'title'               => 'Daftar Pinjaman',
            'pinjaman'            => $pinjaman,
            'totalPinjaman'       => $totalPinjaman,
            'totalPinjamanBiasa'  => $totalPinjamanBiasa,
            'totalPinjamanKhusus' => $totalPinjamanKhusus,
        ]);
    }
}
