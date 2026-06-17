<?php
namespace App\Livewire\Anggota\Simpanan;
use App\Models\Simpanan;
use Livewire\Component;
use Livewire\WithPagination;
class Wajib extends Component
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
        $total_wajib = Simpanan::where('anggota_id', $anggotaId)
            ->where('jenis_simpanan', 'wajib')
            ->sum('jumlah');
        $simpananWajib = Simpanan::where('anggota_id', $anggotaId)
            ->where('jenis_simpanan', 'wajib')
            ->when($this->search, function ($query) {
                $query->where('jumlah', 'like', '%'.$this->search.'%');
            })
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate($this->paginate);
        return view('livewire.anggota.simpanan.wajib', [
            'title' => 'Simpanan Wajib',
            'simpananWajib' => $simpananWajib,
            'total_wajib' => $total_wajib,
        ]);
    }
}
