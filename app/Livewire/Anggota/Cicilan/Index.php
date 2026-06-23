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

    protected $listeners = [
        'dataKoperasiUpdated' => '$refresh',
    ];

    public $search = '';
    public $paginate = 10;
    public $filterStatus = '';

    public function updatingSearch() { $this->resetPage(); }
    public function updatingFilterStatus() { $this->resetPage(); }

    public function render()
    {
        $anggotaId = auth()->user()->anggota->id;

        $pinjamanList = Pinjaman::with([
            'cicilan' => fn($q) => $q->orderBy('cicilan_ke'),
        ])
            ->where('anggota_id', $anggotaId)
            ->when($this->search, fn($q) => $q->where('kode_pinjaman', 'like', '%'.$this->search.'%'))
            ->when($this->filterStatus, fn($q) => $q->where('status', $this->filterStatus))
            ->orderBy('created_at', 'desc')
            ->paginate($this->paginate);

        $totalTagihan = Cicilan::whereHas('pinjaman', fn($q) => $q->where('anggota_id', $anggotaId))
            ->sum('jumlah_tagihan');

        $totalBelumBayar = Cicilan::whereHas('pinjaman', fn($q) => $q->where('anggota_id', $anggotaId))
            ->where('status', 'belum')
            ->sum('jumlah_tagihan');

        $totalLunas = Cicilan::whereHas('pinjaman', fn($q) => $q->where('anggota_id', $anggotaId))
            ->where('status', 'lunas')
            ->sum('jumlah_tagihan');

        return view('livewire.anggota.cicilan.index', [
            'title'           => 'Daftar Cicilan Pinjaman',
            'pinjamanList'    => $pinjamanList,
            'totalTagihan'    => $totalTagihan,
            'totalBelumBayar' => $totalBelumBayar,
            'totalLunas'      => $totalLunas,
        ]);
    }
}
