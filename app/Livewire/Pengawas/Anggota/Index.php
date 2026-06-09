<?php

namespace App\Livewire\Pengawas\Anggota;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Anggota;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme='bootstrap';
    public $paginate='10';
    public $search='';

    public function render()
    {
        return view('livewire.pengawas.anggota.index', [
            'title' => 'Daftar Anggota',
            'anggota' => Anggota::where('no_ktp', 'like', $this->search.'%')
                ->orderBy('tanggal_daftar', 'ASC')->paginate($this->paginate),
        ]);
    }
}