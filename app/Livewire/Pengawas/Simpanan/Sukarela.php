<?php
namespace App\Livewire\Pengawas\Simpanan;
use App\Models\Simpanan;
use Livewire\Component;
use Livewire\WithPagination;
class Sukarela extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected $queryString = ['search' => ['except' => '']];

    protected $listeners = ['dataKoperasiUpdated' => '$refresh'];

    public string $search        = '';
    public int    $paginate      = 10;
    public string $sortBy        = 'created_at';
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
        $simpananSukarela = Simpanan::query()
            ->with('anggota.user')
            ->join('anggota', 'simpanan.anggota_id', '=', 'anggota.id')
            ->select('simpanan.*')
            ->where('jenis_simpanan', 'sukarela')
            ->when(trim($this->search), function ($query) {
                $s = '%' . addcslashes(trim($this->search), '%_') . '%';
                $query->where(function ($q) use ($s) {
                    $q->where('anggota.nama_anggota', 'like', $s)
                      ->orWhere('anggota.kode_anggota', 'like', $s)
                      ->orWhere('simpanan.jumlah', 'like', $s);
                });
            })
            ->when($this->sortBy == 'nama_anggota', function ($query) {
                $query->orderBy('anggota.nama_anggota', $this->sortDirection);
            }, function ($query) {
                $query->orderBy($this->sortBy, $this->sortDirection);
            })
            ->paginate($this->paginate);

        return view('livewire.pengawas.simpanan.sukarela', [
            'title'           => 'Simpanan Sukarela',
            'simpananSukarela' => $simpananSukarela,
            'total_sukarela'  => Simpanan::where('jenis_simpanan', 'sukarela')->sum('jumlah'),
        ]);
    }
}
