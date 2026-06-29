<?php

namespace App\Livewire\Anggota\Pinjaman;

use App\Models\Pinjaman;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
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
    public string $filterJenis   = '';

    public function updatingSearch(): void       { $this->resetPage(); }
    public function updatingFilterStatus(): void { $this->resetPage(); }
    public function updatingFilterJenis(): void  { $this->resetPage(); }
    public function updatingPaginate(): void     { $this->resetPage(); }

    public function resetFilter(): void
    {
        $this->reset('search', 'filterStatus', 'filterJenis');
        $this->resetPage();
    }

    public function render()
    {
        $anggota = auth()->user()->anggota;
        $pinjaman = Pinjaman::with('anggota')
            ->where('anggota_id', $anggota->id)
            ->when(trim($this->search), function ($q) {
                $s = '%' . addcslashes(trim($this->search), '%_') . '%';
                $q->where(function ($sub) use ($s) {
                    $sub->where('kode_pinjaman', 'like', $s)
                        ->orWhere('jumlah_pengajuan', 'like', $s);
                });
            })
            ->when($this->filterStatus, fn($q) => $q->where('status', $this->filterStatus))
            ->when($this->filterJenis, fn($q) => $q->where('jenis_pinjaman', $this->filterJenis))
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate($this->paginate);

        $totalPinjaman = Pinjaman::where('anggota_id', $anggota->id)->where('status', 'aktif')->sum('jumlah_pengajuan');
        $totalPinjamanBiasa = Pinjaman::where('anggota_id', $anggota->id)->where('jenis_pinjaman', 'biasa')->where('status', 'aktif')->sum('jumlah_pengajuan');
        $totalPinjamanKhusus = Pinjaman::where('anggota_id', $anggota->id)->where('jenis_pinjaman', 'khusus')->where('status', 'aktif')->sum('jumlah_pengajuan');

        return view('livewire.anggota.pinjaman.index', [
            'title'              => 'Daftar Pinjaman',
            'pinjaman'           => $pinjaman,
            'totalPinjaman'      => $totalPinjaman,
            'totalPinjamanBiasa' => $totalPinjamanBiasa,
            'totalPinjamanKhusus' => $totalPinjamanKhusus,
        ]);
    }
}
