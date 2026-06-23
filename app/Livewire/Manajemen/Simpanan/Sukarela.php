<?php
namespace App\Livewire\Manajemen\Simpanan;
use App\Models\Simpanan;
use Livewire\Component;
use Livewire\WithPagination;
class Sukarela extends Component
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
    public function render()
    {
        $simpananSukarela = Simpanan::query()
            ->with('anggota.user')
            ->join('anggota', 'simpanan.anggota_id', '=', 'anggota.id')
            ->select('simpanan.*')
            ->where('jenis_simpanan', 'Sukarela')
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
        return view('livewire.manajemen.simpanan.sukarela', [
            'title' => 'Simpanan Sukarela',
            'simpananSukarela' => $simpananSukarela,
            'total_sukarela' => Simpanan::where(
                'jenis_simpanan',
                'Sukarela'
            )->sum('jumlah'),
        ]);
    }
}
