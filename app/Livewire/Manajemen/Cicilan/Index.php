<?php
namespace App\Livewire\Manajemen\Cicilan;
use App\Models\Cicilan;
use Livewire\Component;
use Livewire\WithPagination;
class Index extends Component
{
    use WithPagination;
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
    public function bayar($id)
    {
        $cicilan = Cicilan::findOrFail($id);
        $cicilan->update([
            'status' => 'lunas',
            'tanggal_bayar' => now(),
        ]);
        $sisa = Cicilan::where(
            'pinjaman_id',
            $cicilan->pinjaman_id
        )
            ->where('status', 'belum')
            ->count();
        if ($sisa == 0) {
            $cicilan->pinjaman->update([
                'status' => 'lunas',
            ]);
        }
        session()->flash(
            'success',
            'Cicilan berhasil dibayar'
        );
    }
    public function render()
    {
        $cicilan = Cicilan::with([
            'pinjaman.anggota',
        ])
            ->when($this->search, function ($query) {
                $query->whereHas(
                    'pinjaman.anggota',
                    function ($q) {
                        $q->where(
                            'nama_anggota',
                            'like',
                            '%'.$this->search.'%'
                        );
                    }
                );
            })
            ->orderBy(
                $this->sortBy,
                $this->sortDirection
            )
            ->paginate($this->paginate);
        $totalCicilan =
            Cicilan::sum('jumlah_tagihan');
        $totalBelumBayar =
            Cicilan::where(
                'status',
                'belum'
            )->sum('jumlah_tagihan');
        $totalLunas =
            Cicilan::where(
                'status',
                'lunas'
            )->sum('jumlah_tagihan');
        return view(
            'livewire.manajemen.cicilan.index',
            [
                'title' => 'Daftar Cicilan Pinjaman',
                'cicilan' => $cicilan,
                'totalCicilan' => $totalCicilan,
                'totalBelumBayar' => $totalBelumBayar,
                'totalLunas' => $totalLunas,
            ]
        );
    }
}
