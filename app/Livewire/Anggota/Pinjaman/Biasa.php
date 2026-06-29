<?php

namespace App\Livewire\Anggota\Pinjaman;

use App\Models\Pinjaman;
use Livewire\Component;
use Livewire\WithPagination;

class Biasa extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected $queryString = ['search' => ['except' => '']];

    protected $listeners = ['dataKoperasiUpdated' => '$refresh'];

    public string $search        = '';
    public int    $paginate      = 10;
    public string $sortBy        = 'created_at';
    public string $sortDirection = 'desc';
    public string $filterStatus  = '';

    public function updatingSearch(): void       { $this->resetPage(); }
    public function updatingFilterStatus(): void { $this->resetPage(); }
    public function updatingPaginate(): void     { $this->resetPage(); }

    public function resetFilter(): void
    {
        $this->reset('search', 'filterStatus');
        $this->resetPage();
    }

    public function render()
    {
        $anggota = auth()->user()->anggota;
        $pinjaman = Pinjaman::with('anggota')
            ->where('anggota_id', $anggota->id)
            ->where('jenis_pinjaman', 'biasa')
            ->when(trim($this->search), function ($q) {
                $s = '%' . addcslashes(trim($this->search), '%_') . '%';
                $q->where(function ($sub) use ($s) {
                    $sub->where('kode_pinjaman', 'like', $s)
                        ->orWhere('jumlah_pengajuan', 'like', $s);
                });
            })
            ->when($this->filterStatus, fn($q) => $q->where('status', $this->filterStatus))
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate($this->paginate);

        $totalPinjamanBiasa = Pinjaman::where('anggota_id', $anggota->id)
            ->where('jenis_pinjaman', 'biasa')
            ->where('status', 'aktif')
            ->sum('jumlah_pengajuan');

        return view('livewire.anggota.pinjaman.biasa', [
            'title'              => 'Pinjaman Biasa',
            'pinjaman'           => $pinjaman,
            'totalPinjamanBiasa' => $totalPinjamanBiasa,
        ]);
    }
}
