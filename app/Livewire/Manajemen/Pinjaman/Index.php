<?php

namespace App\Livewire\Manajemen\Pinjaman;

use App\Models\Pinjaman;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    protected $queryString = ['search' => ['except' => '']];

    protected $listeners = ['dataKoperasiUpdated' => '$refresh'];

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

    public function resetFilter(): void
    {
        $this->reset('search', 'filterJenis', 'filterStatus');
        $this->resetPage();
    }

    public function render()
    {
        $pinjaman = Pinjaman::with('anggota')
            ->when(trim($this->search), function ($q) {
                $q->where(function ($sub) {
                    $s = '%' . addcslashes(trim($this->search), '%_') . '%';
                    $sub->whereHas('anggota', function ($aq) use ($s) {
                        $aq->where('nama_anggota', 'like', $s)
                           ->orWhere('kode_anggota', 'like', $s);
                    })->orWhere('kode_pinjaman', 'like', $s);
                });
            })
            ->when($this->filterJenis,  fn($q) => $q->where('jenis_pinjaman', $this->filterJenis))
            ->when($this->filterStatus, fn($q) => $q->where('status', $this->filterStatus))
            ->orderBy($this->sortBy, $this->sortDir)
            ->paginate($this->paginate);

        $totalPinjaman       = Pinjaman::where('status', 'aktif')->sum('jumlah_pengajuan');
        $totalPinjamanBiasa  = Pinjaman::where('jenis_pinjaman', 'biasa')->where('status', 'aktif')->sum('jumlah_pengajuan');
        $totalPinjamanKhusus = Pinjaman::where('jenis_pinjaman', 'khusus')->where('status', 'aktif')->sum('jumlah_pengajuan');

        return view('livewire.manajemen.pinjaman.index', [
            'title'               => 'Daftar Pinjaman',
            'pinjaman'            => $pinjaman,
            'totalPinjaman'       => $totalPinjaman,
            'totalPinjamanBiasa'  => $totalPinjamanBiasa,
            'totalPinjamanKhusus' => $totalPinjamanKhusus,
        ]);
    }
}
