<?php
namespace App\Livewire\Manajemen\Simpanan;
use App\Models\Simpanan;
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

    public function updatingSearch(): void   { $this->resetPage(); }
    public function updatingPaginate(): void { $this->resetPage(); }

    public function resetFilter(): void
    {
        $this->reset('search');
        $this->resetPage();
    }

    public function create()
    {
        $this->dispatch('openCreate');
    }

    public function render()
    {
        $wajib    = Simpanan::where('jenis_simpanan', 'wajib')->sum('jumlah');
        $pokok    = Simpanan::where('jenis_simpanan', 'pokok')->sum('jumlah');
        $sukarela = Simpanan::where('jenis_simpanan', 'sukarela')->sum('jumlah');

        $simpanan = Simpanan::query()
            ->with('anggota.user')
            ->join('anggota', 'simpanan.anggota_id', '=', 'anggota.id')
            ->select('simpanan.*')
            ->when(trim($this->search), function ($query) {
                $s = '%' . addcslashes(trim($this->search), '%_') . '%';
                $query->where(function ($q) use ($s) {
                    $q->where('anggota.nama_anggota', 'like', $s)
                      ->orWhere('anggota.kode_anggota', 'like', $s)
                      ->orWhere('simpanan.jenis_simpanan', 'like', $s)
                      ->orWhere('simpanan.jumlah', 'like', $s);
                });
            })
            ->when($this->sortBy == 'nama_anggota', function ($query) {
                $query->orderBy('anggota.nama_anggota', $this->sortDirection);
            }, function ($query) {
                $query->orderBy($this->sortBy, $this->sortDirection);
            })
            ->paginate($this->paginate);

        return view('livewire.manajemen.simpanan.index', [
            'title'         => 'Daftar Simpanan',
            'simpanan'      => $simpanan,
            'wajib'         => $wajib,
            'pokok'         => $pokok,
            'sukarela'      => $sukarela,
            'total_simpanan' => $wajib + $pokok + $sukarela,
        ]);
    }
}
