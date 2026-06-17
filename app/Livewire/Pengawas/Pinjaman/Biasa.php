<?php
namespace App\Livewire\Pengawas\Pinjaman;
use Livewire\Component;
class Biasa extends Component
{
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
        return view('livewire.pengawas.pinjaman.biasa', [
            'title' => 'Daftar Pinjaman Biasa',
        ]);
    }
}
