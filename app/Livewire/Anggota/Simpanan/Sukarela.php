<?php
namespace App\Livewire\Anggota\Simpanan;
use App\Models\Simpanan;
use Livewire\Component;
use Livewire\WithPagination;
class Sukarela extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected $queryString = ['search' => ['except' => '']];

    public string $search = '';
    public int $paginate = 10;
    public string $sortBy = 'created_at';
    public string $sortDirection = 'desc';

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
        $total_sukarela = Simpanan::where('anggota_id', $anggotaId)->where('jenis_simpanan', 'sukarela')->sum('jumlah');
        $simpananSukarela = Simpanan::where('anggota_id', $anggotaId)
            ->where('jenis_simpanan', 'sukarela')
            ->when(trim($this->search), function ($query) {
                $s = '%' . addcslashes(trim($this->search), '%_') . '%';
                $query->where(function ($q) use ($s) {
                    $q->where('jumlah', 'like', $s)
                      ->orWhere('tanggal', 'like', $s);
                });
            })
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate($this->paginate);
        return view('livewire.anggota.simpanan.sukarela', [
            'title' => 'Simpanan Sukarela',
            'simpananSukarela' => $simpananSukarela,
            'total_sukarela' => $total_sukarela,
        ]);
    }
}
