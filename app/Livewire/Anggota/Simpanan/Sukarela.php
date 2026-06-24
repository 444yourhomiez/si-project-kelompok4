<?php
namespace App\Livewire\Anggota\Simpanan;
use App\Models\Simpanan;
use Livewire\Component;
use Livewire\WithPagination;
class Sukarela extends Component
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
        $total_sukarela = Simpanan::where('anggota_id', $anggotaId)
            ->where('jenis_simpanan', 'sukarela')
            ->sum('jumlah');
        $simpananSukarela = Simpanan::where('anggota_id', $anggotaId)
            ->where('jenis_simpanan', 'sukarela')
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('jumlah', 'like', '%'.$this->search.'%')
                      ->orWhere('tanggal', 'like', '%'.$this->search.'%');
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
