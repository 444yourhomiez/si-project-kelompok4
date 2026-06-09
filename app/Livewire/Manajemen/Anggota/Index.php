<?php

namespace App\Livewire\Manajemen\Anggota;

use App\Models\Anggota;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;

class Index extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $kode_anggota, $nama_anggota, $no_ktp;
    public $sortBy = 'created_at';
    public $sortDirection = 'desc';
    public $paginate = 10;
    public $search = '';

    #[On('refreshAnggota')]
    public function refreshAnggota()
    {
        $this->resetPage();
    }

    public function updatedPaginate()
    {
        $this->resetPage();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $data = array(

            'anggota' => Anggota::query()

                ->when($this->search, function ($query) {

                    $query->where(function ($q) {

                        $q->where('kode_anggota', 'like', '%' . $this->search . '%')
                            ->orWhere('nama_anggota', 'like', '%' . $this->search . '%')
                            ->orWhere('no_ktp', 'like', '%' . $this->search . '%');
                    });
                })

                ->when($this->sortBy == 'kode_anggota', function ($query) {

                    $query->orderByRaw("
                        CASE
                            WHEN kode_anggota IS NULL
                            OR kode_anggota = ''
                            THEN 999999

                            ELSE CAST(
                                SUBSTRING_INDEX(kode_anggota, '-', -1)
                                AS UNSIGNED
                            )
                        END {$this->sortDirection}
                    ");
                }, function ($query) {

                    $query->orderBy(
                        $this->sortBy,
                        $this->sortDirection
                    );
                })

                ->paginate($this->paginate),

            'totalAnggota' => User::where('role', 'anggota')->count(),

            'anggotaDisetujui' => User::where('role', 'anggota')
                ->where('status', 'disetujui')
                ->count(),

            'anggotaMenunggu' => User::where('role', 'anggota')
                ->where('status', 'menunggu')
                ->count(),

        );

        return view('livewire.manajemen.anggota.index', $data + [
            'title' => 'Daftar Anggota',
        ]);
    }
}
