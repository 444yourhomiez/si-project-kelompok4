<?php
namespace App\Livewire\Anggota\Simpanan;
use App\Models\Simpanan;
use Livewire\Component;
use Livewire\WithPagination;
class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected $queryString = ['search' => ['except' => '']];

    public string $search = '';
    public int $paginate = 10;

    public function updatingSearch(): void   { $this->resetPage(); }
    public function updatingPaginate(): void { $this->resetPage(); }

    public function resetFilter(): void
    {
        $this->reset('search');
        $this->resetPage();
    }

    public function render()
    {
        $anggotaId = auth()->user()->anggota->id;
        $wajib = Simpanan::where('anggota_id', $anggotaId)->where('jenis_simpanan', 'wajib')->sum('jumlah');
        $pokok = Simpanan::where('anggota_id', $anggotaId)->where('jenis_simpanan', 'pokok')->sum('jumlah');
        $sukarela = Simpanan::where('anggota_id', $anggotaId)->where('jenis_simpanan', 'sukarela')->sum('jumlah');
        $simpanan = Simpanan::query()
            ->where('anggota_id', $anggotaId)
            ->when(trim($this->search), function ($query) {
                $s = '%' . addcslashes(trim($this->search), '%_') . '%';
                $query->where(function ($q) use ($s) {
                    $q->where('jenis_simpanan', 'like', $s)
                      ->orWhere('jumlah', 'like', $s)
                      ->orWhere('tanggal', 'like', $s);
                });
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
