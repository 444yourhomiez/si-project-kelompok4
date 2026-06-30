<?php

namespace App\Livewire\Anggota\Cicilan;

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

    protected $listeners = ['dataKoperasiUpdated' => '$refresh'];

    public string $search       = '';
    public int    $paginate     = 10;
    public string $filterStatus = '';
    public string $filterJenis  = '';

    public function updatingSearch(): void       { $this->resetPage(); }
    public function updatingFilterStatus(): void { $this->resetPage(); }
    public function updatingFilterJenis(): void  { $this->resetPage(); }
    public function updatingPaginate(): void     { $this->resetPage(); }

    public function resetFilter(): void
    {
        $this->reset('search', 'filterStatus', 'filterJenis');
        $this->resetPage();
    }

    public function render()
    {
        $anggotaId = auth()->user()->anggota->id;

        $pinjamanList = Pinjaman::with([
            'cicilan' => fn($q) => $q->orderBy('cicilan_ke'),
        ])
            ->where('anggota_id', $anggotaId)
            ->when(trim($this->search), function ($q) {
                $s = '%' . addcslashes(trim($this->search), '%_') . '%';
                $q->where('kode_pinjaman', 'like', $s);
            })
            ->when($this->filterStatus, fn($q) => $q->where('status', $this->filterStatus))
            ->when($this->filterJenis,  fn($q) => $q->where('jenis_pinjaman', $this->filterJenis))
            ->orderBy('created_at', 'desc')
            ->paginate($this->paginate);

        $totalTagihan    = Cicilan::whereHas('pinjaman', fn($q) => $q->where('anggota_id', $anggotaId))->sum('jumlah_tagihan');
        $totalBelumBayar = Cicilan::whereHas('pinjaman', fn($q) => $q->where('anggota_id', $anggotaId))->where('status', 'belum')->sum('jumlah_tagihan');
        $totalLunas      = Cicilan::whereHas('pinjaman', fn($q) => $q->where('anggota_id', $anggotaId))->where('status', 'lunas')->sum('jumlah_tagihan');

        return view('livewire.anggota.cicilan.index', [
            'title'           => 'Daftar Cicilan Pinjaman',
            'pinjamanList'    => $pinjamanList,
            'totalTagihan'    => $totalTagihan,
            'totalBelumBayar' => $totalBelumBayar,
            'totalLunas'      => $totalLunas,
        ]);
    }
}
