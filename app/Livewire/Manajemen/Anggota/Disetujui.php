<?php

namespace App\Livewire\Manajemen\Anggota;

use App\Models\Anggota;
use Livewire\Component;
use Livewire\WithPagination;

class Disetujui extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    
    protected $listeners = [
        'refreshAnggota' => '$refresh',
    ];

    public $sortBy = 'created_at';
    public $sortDirection = 'desc';
    public $search = '';
    public $paginate = 10;

    // SIMPAN QUERY STRING
    protected $queryString = [
        'search' => ['except' => ''],
        'paginate' => ['except' => 10],
        'sortBy' => ['except' => 'created_at'],
        'sortDirection' => ['except' => 'desc'],
    ];

    // RESET PAGE SAAT SEARCH
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $anggota = Anggota::with('user')

            ->whereHas('user', function ($query) {

                $query->where('status', 'disetujui');
            })

            ->when($this->search, function ($query) {

                $query->where(function ($q) {

                    $q->where('no_ktp', 'like', '%' . $this->search . '%')
                        ->orWhere('nama_anggota', 'like', '%' . $this->search . '%')
                        ->orWhere('kode_anggota', 'like', '%' . $this->search . '%');
                });
            })

            ->when($this->sortBy == 'kode_anggota', function ($query) {

                $query->orderByRaw("
                CAST(
                    SUBSTRING_INDEX(kode_anggota, '-', -1)
                AS UNSIGNED)
                {$this->sortDirection}
            ");
            }, function ($query) {

                $query->orderBy(
                    $this->sortBy,
                    $this->sortDirection
                );
            })

            ->paginate($this->paginate);

        return view('livewire.manajemen.anggota.disetujui', [
            'title' => 'Anggota Disetujui',
            'anggota' => $anggota,
        ]);
    }
}
