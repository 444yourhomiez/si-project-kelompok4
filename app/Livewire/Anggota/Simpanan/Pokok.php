<?php

namespace App\Livewire\Anggota\Simpanan;

use App\Models\Simpanan;
use Livewire\Component;
use Livewire\WithPagination;

class Pokok extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public string $search = '';
    public int $paginate = 10;
    public string $sortBy = 'created_at';
    public string $sortDirection = 'desc';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $anggotaId = auth()->user()->anggota->id;

        $total_pokok = Simpanan::where('anggota_id', $anggotaId)
            ->where('jenis_simpanan', 'pokok')
            ->sum('jumlah');

        $simpananPokok = Simpanan::where('anggota_id', $anggotaId)
            ->where('jenis_simpanan', 'pokok')
            ->when($this->search, function ($query) {
                $query->where('jumlah', 'like', '%' . $this->search . '%');
            })
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate($this->paginate);

        return view('livewire.anggota.simpanan.pokok', [
            'title' => 'Simpanan Pokok',
            'simpananPokok' => $simpananPokok,
            'total_pokok' => $total_pokok,
        ]);
    }
}