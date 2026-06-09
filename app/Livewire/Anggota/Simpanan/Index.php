<?php

namespace App\Livewire\Anggota\Simpanan;

use App\Models\Simpanan;
use Livewire\Component;

class Index extends Component
{

    protected $listeners = ['refreshSimpanan' => '$refresh'];

    public function create()
    {
        $this->reset([
            'anggota_id',
            'jenis_simpanan',
            'jumlah'
        ]);

        $this->resetValidation();
    }


    public function render()
    {
        $wajib = Simpanan::where('jenis_simpanan', 'wajib')->sum('jumlah');
        $pokok = Simpanan::where('jenis_simpanan', 'pokok')->sum('jumlah');
        $sukarela = Simpanan::where('jenis_simpanan', 'sukarela')->sum('jumlah');

        $total_simpanan = $wajib + $pokok + $sukarela;

        return view('livewire.anggota.simpanan.index', [
            'title' => 'Simpanan',
            'simpanan' => Simpanan::with('anggota')->latest()->get(),

            'wajib' => $wajib,
            'pokok' => $pokok,
            'sukarela' => $sukarela,
            'total_simpanan' => $total_simpanan,
        ]);
    }
}
