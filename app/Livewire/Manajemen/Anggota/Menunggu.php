<?php
namespace App\Livewire\Manajemen\Anggota;
use App\Models\Anggota;
use Livewire\Component;
use Livewire\WithPagination;
class Menunggu extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $sortBy = 'created_at';
    public $sortDirection = 'desc';
    public $search = '';
    public $paginate = 10;
    protected $queryString = [
        'search' => ['except' => ''],
        'paginate' => ['except' => 10],
        'sortBy' => ['except' => 'created_at'],
        'sortDirection' => ['except' => 'desc'],
    ];
    public function updatingSearch()
    {
        $this->resetPage();
    }
    public function render()
    {
        $anggota = Anggota::with('user')
            ->whereHas('user', function ($query) {
                $query->where('status', 'menunggu');
            })
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('no_ktp', 'like', '%'.$this->search.'%')
                        ->orWhere('nama_anggota', 'like', '%'.$this->search.'%');
                });
            })
            ->orderBy(
                $this->sortBy,
                $this->sortDirection
            )
            ->paginate($this->paginate);
        return view('livewire.manajemen.anggota.menunggu', [
            'title' => 'Menunggu Verifikasi',
            'anggota' => $anggota,
        ]);
    }
}
