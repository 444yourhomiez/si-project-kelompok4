<?php
namespace App\Livewire\Manajemen\Simpanan;
use App\Models\Simpanan;
use Livewire\Component;
use Livewire\WithPagination;
class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = [
        'dataKoperasiUpdated' => '$refresh',
    ];
    public $search = '';
    public $paginate = 10;
    public $sortBy = 'created_at';
    public $sortDirection = 'desc';
    public function updatingSearch()
    {
        $this->resetPage();
    }
    public function create()
    {
        $this->reset([
            'anggota_id',
            'jenis_simpanan',
            'jumlah',
        ]);
        $this->resetValidation();
    }
    public function render()
    {
        $wajib = Simpanan::where('jenis_simpanan', 'wajib')
            ->sum('jumlah');
        $pokok = Simpanan::where('jenis_simpanan', 'pokok')
            ->sum('jumlah');
        $sukarela = Simpanan::where('jenis_simpanan', 'sukarela')
            ->sum('jumlah');
        $total_simpanan = $wajib + $pokok + $sukarela;
        $simpanan = Simpanan::query()
            ->with('anggota.user')
            ->join('anggota', 'simpanan.anggota_id', '=', 'anggota.id')
            ->select('simpanan.*')
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where(
                        'anggota.nama_anggota',
                        'like',
                        '%'.$this->search.'%'
                    )
                        ->orWhere(
                            'anggota.kode_anggota',
                            'like',
                            '%'.$this->search.'%'
                        )
                        ->orWhere(
                            'simpanan.jenis_simpanan',
                            'like',
                            '%'.$this->search.'%'
                        )
                        ->orWhere(
                            'simpanan.jumlah',
                            'like',
                            '%'.$this->search.'%'
                        );
                });
            })
            ->when($this->sortBy == 'nama_anggota', function ($query) {
                $query->orderBy(
                    'anggota.nama_anggota',
                    $this->sortDirection
                );
            }, function ($query) {
                $query->orderBy(
                    $this->sortBy,
                    $this->sortDirection
                );
            })
            ->paginate($this->paginate);
        return view('livewire.manajemen.simpanan.index', [
            'title' => 'Daftar Simpanan',
            'simpanan' => $simpanan,
            'wajib' => $wajib,
            'pokok' => $pokok,
            'sukarela' => $sukarela,
            'total_simpanan' => $total_simpanan,
        ]);
    }
}
