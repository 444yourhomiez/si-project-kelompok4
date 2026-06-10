<?php

namespace App\Livewire\Pengawas\Pinjaman;

use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public string $search = '';
    public int $paginate = 10;
    public string $sortBy = 'created_at';
    public string $sortDirection = 'desc';

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.pengawas.pinjaman.index', [
            'title' => 'Monitoring Pinjaman',
        ]);
    }
}
