<?php
namespace App\Livewire\Pengawas\Rekap;
use Livewire\Component;
class Index extends Component
{
    public function render()
    {
        return view('livewire.pengawas.rekap.index', [
            'title' => 'Rekapitulasi Harian',
        ]);
    }
}
