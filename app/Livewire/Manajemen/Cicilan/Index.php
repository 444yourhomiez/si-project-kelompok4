<?php

namespace App\Livewire\Manajemen\Cicilan;

use App\Models\Cicilan;
use App\Models\Pinjaman;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected $queryString = [
        'search'       => ['except' => ''],
        'filterStatus' => ['except' => ''],
        'filterJenis'  => ['except' => ''],
    ];

    public string $search       = '';
    public string $filterStatus = '';
    public string $filterJenis  = '';
    public int    $paginate     = 10;
    public string $sortBy       = 'created_at';
    public string $sortDir      = 'desc';

    public function updatingSearch(): void       { $this->resetPage(); }
    public function updatingPaginate(): void     { $this->resetPage(); }
    public function updatingFilterStatus(): void { $this->resetPage(); }
    public function updatingFilterJenis(): void  { $this->resetPage(); }

    public function resetFilter(): void
    {
        $this->reset('search', 'filterStatus', 'filterJenis');
        $this->resetPage();
    }

    public function render()
    {
        $pinjaman = Pinjaman::with(['anggota', 'cicilan'])
            ->whereIn('status', ['aktif', 'lunas', 'disetujui'])
            ->when(trim($this->search), function ($q) {
                $s = '%' . addcslashes(trim($this->search), '%_') . '%';
                $q->where(function ($sub) use ($s) {
                    $sub->whereHas('anggota', function ($aq) use ($s) {
                        $aq->where('nama_anggota', 'like', $s)
                           ->orWhere('kode_anggota', 'like', $s);
                    })->orWhere('kode_pinjaman', 'like', $s);
                });
            })
            ->when($this->filterStatus, fn($q) => $q->where('status', $this->filterStatus))
            ->when($this->filterJenis,  fn($q) => $q->where('jenis_pinjaman', $this->filterJenis))
            ->orderBy($this->sortBy, $this->sortDir)
            ->paginate($this->paginate);

        $totalCicilan    = Cicilan::sum('jumlah_tagihan');
        $totalBelumBayar = Cicilan::where('status', 'belum')->sum('jumlah_tagihan');
        $totalLunas      = Cicilan::where('status', 'lunas')->sum('jumlah_tagihan');

        return view('livewire.manajemen.cicilan.index', [
            'title'           => 'Daftar Cicilan Pinjaman',
            'pinjaman'        => $pinjaman,
            'totalCicilan'    => $totalCicilan,
            'totalBelumBayar' => $totalBelumBayar,
            'totalLunas'      => $totalLunas,
        ]);
    }
}
