<?php
namespace App\Livewire\Anggota\Simpanan;
use App\Models\Simpanan;
use Livewire\Component;
use Livewire\WithPagination;
class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public string $search = '';
    public int $paginate = 10;
    public function updatingSearch(): void
    {
        $this->resetPage();
    }
    public function render()
    {
        $anggotaId = auth()->user()->anggota->id;
        $wajib = Simpanan::where('anggota_id', $anggotaId)
            ->where('jenis_simpanan', 'wajib')
            ->sum('jumlah');
        $pokok = Simpanan::where('anggota_id', $anggotaId)
            ->where('jenis_simpanan', 'pokok')
            ->sum('jumlah');
        $sukarela = Simpanan::where('anggota_id', $anggotaId)
            ->where('jenis_simpanan', 'sukarela')
            ->sum('jumlah');
        $simpanan = Simpanan::query()
            ->where('anggota_id', $anggotaId)
            ->when($this->search, function ($query) {
                $query->where('jenis_simpanan', 'like', '%'.$this->search.'%');
            })
            ->latest()
            ->paginate($this->paginate);
        return view('livewire.anggota.simpanan.index', [
            'title' => 'Daftar Simpanan',
            'simpanan' => $simpanan,
            'wajib' => $wajib,
            'pokok' => $pokok,
            'sukarela' => $sukarela,
            'total_simpanan' => $wajib + $pokok + $sukarela,
        ]);
    }
}
