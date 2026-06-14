<?php

namespace App\Livewire\Manajemen\Cicilan;

use Livewire\Component;

class Pribadi extends Component
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
        return view('livewire.manajemen.cicilan.pribadi', [

            'title' => 'Cicilan Pinjaman Pribadi',

        ]);
    }
}
