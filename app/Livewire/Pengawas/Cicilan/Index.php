<?php

namespace App\Livewire\Pengawas\Cicilan;

use App\Models\Cicilan;
use App\Models\Pinjaman;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public string $search   = '';
    public int    $paginate = 10;
    public string $sortBy   = 'created_at';
    public string $sortDir  = 'desc';

    public function updatingSearch(): void { $this->resetPage(); }

    public function render()
    {
        $pinjaman = Pinjaman::with(['anggota', 'cicilan'])
            ->whereIn('status', ['aktif', 'lunas', 'disetujui'])
            ->when($this->search, fn($q) => $q->whereHas(
                'anggota',
                fn($aq) => $aq->where('nama_anggota', 'like', "%{$this->search}%")
                              ->orWhere('kode_anggota', 'like', "%{$this->search}%")
            ))
            ->orderBy($this->sortBy, $this->sortDir)
            ->paginate($this->paginate);

        $totalCicilan    = Cicilan::sum('jumlah_tagihan');
        $totalBelumBayar = Cicilan::where('status', 'belum')->sum('jumlah_tagihan');
        $totalLunas      = Cicilan::where('status', 'lunas')->sum('jumlah_tagihan');

        return view('livewire.pengawas.cicilan.index', [
            'title'           => 'Daftar Cicilan Pinjaman',
            'pinjaman'        => $pinjaman,
            'totalCicilan'    => $totalCicilan,
            'totalBelumBayar' => $totalBelumBayar,
            'totalLunas'      => $totalLunas,
        ]);
    }
}
