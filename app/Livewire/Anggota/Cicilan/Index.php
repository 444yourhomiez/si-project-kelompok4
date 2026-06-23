<?php

namespace App\Livewire\Anggota\Cicilan;

use App\Models\Cicilan;
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

    public $sortBy = 'created_at';
    public $sortDirection = 'desc';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $anggotaId = auth()->user()->anggota->id;

        $cicilan = Cicilan::with([
            'pinjaman'
        ])

            ->whereHas('pinjaman', function ($query) use ($anggotaId) {

                $query->where(
                    'anggota_id',
                    $anggotaId
                );
            })

            ->when($this->search, function ($query) {

                $query->whereHas('pinjaman', function ($q) {

                    $q->where(
                        'kode_pinjaman',
                        'like',
                        '%' . $this->search . '%'
                    );
                });
            })

            ->orderBy(
                $this->sortBy,
                $this->sortDirection
            )

            ->paginate($this->paginate);

        $totalTagihan =
            Cicilan::whereHas('pinjaman', function ($query) use ($anggotaId) {

                $query->where(
                    'anggota_id',
                    $anggotaId
                );
            })->sum('jumlah_tagihan');

        $totalBelumBayar =
            Cicilan::whereHas('pinjaman', function ($query) use ($anggotaId) {

                $query->where(
                    'anggota_id',
                    $anggotaId
                );
            })
            ->where('status', 'belum')
            ->sum('jumlah_tagihan');

        $totalLunas =
            Cicilan::whereHas('pinjaman', function ($query) use ($anggotaId) {

                $query->where(
                    'anggota_id',
                    $anggotaId
                );
            })
            ->where('status', 'lunas')
            ->sum('jumlah_tagihan');

        $jumlahCicilan =
            Cicilan::whereHas('pinjaman', function ($query) use ($anggotaId) {

                $query->where(
                    'anggota_id',
                    $anggotaId
                );
            })->count();

        return view(
            'livewire.anggota.cicilan.index',
            [

                'title' => 'Daftar Cicilan Pinjaman',

                'cicilan' => $cicilan,

                'totalTagihan' => $totalTagihan,

                'totalBelumBayar' => $totalBelumBayar,

                'totalLunas' => $totalLunas,

                'jumlahCicilan' => $jumlahCicilan,

            ]
        );
    }
}
