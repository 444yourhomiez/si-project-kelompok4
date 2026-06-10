<?php

namespace App\Livewire\Pengawas\Rekap;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.manajemen.rekap.index', [
            'title' => 'Rekapitulasi Harian',
        ]);
    }
}
