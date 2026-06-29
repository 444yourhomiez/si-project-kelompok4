<?php

namespace App\Livewire\Pengawas\Pinjaman;

use App\Models\Pinjaman;
use Livewire\Component;
use Livewire\WithPagination;

class Khusus extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    protected $queryString = ['search' => ['except' => '']];

    public string $search       = '';
    public string $filterStatus = '';
    public int    $paginate     = 10;
    public string $sortBy       = 'created_at';
    public string $sortDir      = 'desc';

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
        $pinjaman = Pinjaman::with('anggota')
            ->where('jenis_pinjaman', 'khusus')
            ->when(trim($this->search), function ($q) {
                $q->where(function ($sub) {
                    $s = '%' . addcslashes(trim($this->search), '%_') . '%';
                    $sub->whereHas('anggota', function ($aq) use ($s) {
                        $aq->where('nama_anggota', 'like', $s)
                           ->orWhere('kode_anggota', 'like', $s);
                    })->orWhere('kode_pinjaman', 'like', $s);
                });
            })
            ->when($this->filterStatus, fn($q) => $q->where('status', $this->filterStatus))
            ->orderBy($this->sortBy, $this->sortDir)
            ->paginate($this->paginate);

        $totalPinjamanKhusus = Pinjaman::where('jenis_pinjaman', 'khusus')
            ->where('status', 'aktif')
            ->sum('jumlah_pengajuan');

        return view('livewire.pengawas.pinjaman.khusus', [
            'title'               => 'Pinjaman Khusus',
            'pinjaman'            => $pinjaman,
            'totalPinjamanKhusus' => $totalPinjamanKhusus,
        ]);
    }
}
