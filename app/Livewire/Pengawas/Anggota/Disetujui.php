<?php
namespace App\Livewire\Pengawas\Anggota;
use App\Models\Anggota;
use Livewire\Component;
use Livewire\WithPagination;
class Disetujui extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected $queryString = [
        'search'        => ['except' => ''],
        'paginate'      => ['except' => 10],
        'sortBy'        => ['except' => 'created_at'],
        'sortDirection' => ['except' => 'desc'],
    ];

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
        $anggota = Anggota::with('user')
            ->whereHas('user', fn($q) => $q->where('status', 'disetujui'))
            ->when(trim($this->search), function ($query) {
                $s = '%' . addcslashes(trim($this->search), '%_') . '%';
                $query->where(function ($q) use ($s) {
                    $q->where('no_ktp', 'like', $s)
                      ->orWhere('nama_anggota', 'like', $s)
                      ->orWhere('kode_anggota', 'like', $s);
                });
            })
            ->when($this->sortBy == 'kode_anggota', function ($query) {
                $query->orderByRaw("
                    CAST(SUBSTRING_INDEX(kode_anggota, '-', -1) AS UNSIGNED) {$this->sortDirection}
                ");
            }, function ($query) {
                $query->orderBy($this->sortBy, $this->sortDirection);
            })
            ->paginate($this->paginate);

        return view('livewire.pengawas.anggota.disetujui', [
            'title'   => 'Anggota Disetujui',
            'anggota' => $anggota,
        ]);
    }
}
