<?php
namespace App\Livewire\Manajemen\Anggota;
use App\Models\Anggota;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected $queryString = ['search' => ['except' => '']];

    protected $listeners = ['refreshAnggota' => 'refreshAnggota'];

    public string $search        = '';
    public string $sortBy        = 'created_at';
    public string $sortDirection = 'desc';
    public int    $paginate      = 10;

    public function refreshAnggota(): void { $this->resetPage(); }
    public function updatingSearch(): void  { $this->resetPage(); }
    public function updatingPaginate(): void { $this->resetPage(); }

    public function resetFilter(): void
    {
        $this->reset('search');
        $this->resetPage();
    }

    public function render()
    {
        $anggota = Anggota::with('user')
            ->when(trim($this->search), function ($query) {
                $s = '%' . addcslashes(trim($this->search), '%_') . '%';
                $query->where(function ($q) use ($s) {
                    $q->where('kode_anggota', 'like', $s)
                      ->orWhere('nama_anggota', 'like', $s)
                      ->orWhere('no_ktp', 'like', $s);
                });
            })
            ->when($this->sortBy == 'kode_anggota', function ($query) {
                $query->orderByRaw("
                    CASE WHEN kode_anggota IS NULL OR kode_anggota = '' THEN 999999
                    ELSE CAST(SUBSTRING_INDEX(kode_anggota, '-', -1) AS UNSIGNED) END {$this->sortDirection}
                ");
            }, function ($query) {
                $query->orderBy($this->sortBy, $this->sortDirection);
            })
            ->paginate($this->paginate);

        return view('livewire.manajemen.anggota.index', [
            'title'           => 'Daftar Anggota',
            'anggota'         => $anggota,
            'totalAnggota'    => User::where('role', 'anggota')->where('status', '!=', 'ditolak')->count(),
            'anggotaDisetujui' => User::where('role', 'anggota')->where('status', 'disetujui')->count(),
            'anggotaMenunggu' => User::where('role', 'anggota')->where('status', 'menunggu')->count(),
        ]);
    }
}
