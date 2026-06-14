<?php

namespace App\Livewire\Anggota\Cicilan;

use Livewire\Component;

class Index extends Component
{
    protected $listeners = [

        'dataKoperasiUpdated' => '$refresh'

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
        return view('livewire.anggota.cicilan.index', [

            'title' => 'Daftar Cicilan Pinjaman',

        ]);
    }
}
