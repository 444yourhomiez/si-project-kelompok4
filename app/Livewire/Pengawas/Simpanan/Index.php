<?php

namespace App\Livewire\Pengawas\Simpanan;

use App\Models\Simpanan;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public string $search = '';
    public int $paginate = 10;
    public string $sortBy = 'created_at';
    public string $sortDirection = 'desc';

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function render()
    {
        $wajib = Simpanan::where('jenis_simpanan', 'wajib')->sum('jumlah');
        $pokok = Simpanan::where('jenis_simpanan', 'pokok')->sum('jumlah');
        $sukarela = Simpanan::where('jenis_simpanan', 'sukarela')->sum('jumlah');

        $simpanan = Simpanan::query()
            ->with('anggota.user')
            ->join('anggota', 'simpanan.anggota_id', '=', 'anggota.id')
            ->select('simpanan.*')
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('anggota.nama_anggota', 'like', '%' . $this->search . '%')
                        ->orWhere('anggota.kode_anggota', 'like', '%' . $this->search . '%')
                        ->orWhere('simpanan.jenis_simpanan', 'like', '%' . $this->search . '%')
                        ->orWhere('simpanan.jumlah', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->sortBy == 'nama_anggota', function ($query) {
                $query->orderBy('anggota.nama_anggota', $this->sortDirection);
            }, function ($query) {
                $query->orderBy($this->sortBy, $this->sortDirection);
            })
            ->paginate($this->paginate);

        return view('livewire.pengawas.simpanan.index', [
            'title'          => 'Daftar Simpanan',
            'simpanan'       => $simpanan,
            'wajib'          => $wajib,
            'pokok'          => $pokok,
            'sukarela'       => $sukarela,
            'total_simpanan' => $wajib + $pokok + $sukarela,
        ]);
    }
}
