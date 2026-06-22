<?php

namespace App\Livewire\Anggota\Pinjaman;

use App\Models\Pinjaman;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
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
        $anggota = auth()->user()->anggota;
        $pinjaman = Pinjaman::with('anggota')
            ->where(
                'anggota_id',
                $anggota->id
            )
            ->when($this->search, function ($query) {
                $query->where(
                    'kode_pinjaman',
                    'like',
                    '%' . $this->search . '%'
                );
            })
            ->orderBy(
                $this->sortBy,
                $this->sortDirection
            )
            ->paginate($this->paginate);
        $totalPinjaman =
            Pinjaman::where(
                'anggota_id',
                $anggota->id
            )
            ->where(
                'status',
                'aktif'
            )->sum('jumlah_pengajuan');

        $totalPinjamanBiasa =
            Pinjaman::where(
                'anggota_id',
                $anggota->id
            )
            ->where(
                'jenis_pinjaman',
                'biasa'
            )
            ->where(
                'status',
                'aktif'
            )
            ->sum('jumlah_pengajuan');

        $totalPinjamanKhusus =
            Pinjaman::where(
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
            'livewire.anggota.pinjaman.index',
            [
                'title' => 'Daftar Pinjaman',
                'pinjaman' => $pinjaman,
                'totalPinjaman' => $totalPinjaman,
                'totalPinjamanBiasa' => $totalPinjamanBiasa,
                'totalPinjamanKhusus' => $totalPinjamanKhusus,
            ]
        );
    }
}
