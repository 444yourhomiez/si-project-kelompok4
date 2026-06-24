<?php
namespace App\Livewire\Pengawas\Simpanan;
use App\Models\Simpanan;
use Livewire\Component;
use Livewire\WithPagination;
class Pokok extends Component
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
    public function updatingSearch()   { $this->resetPage(); }
    public function updatingPaginate() { $this->resetPage(); }
    public function render()
    {
        $simpananPokok = Simpanan::query()
            ->with('anggota.user')
            ->join('anggota', 'simpanan.anggota_id', '=', 'anggota.id')
            ->select('simpanan.*')
            ->where('jenis_simpanan', 'pokok')
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
        return view('livewire.pengawas.simpanan.pokok', [
            'title' => 'Simpanan Pokok',
            'simpananPokok' => $simpananPokok,
            'total_pokok' => Simpanan::where(
                'jenis_simpanan',
                'pokok'
            )->sum('jumlah'),
        ]);
    }
}
