<?php

namespace App\Livewire\Manajemen\Rekap;

use Livewire\Component;

class Dum extends Component
{
    public function render()
    {
        return view('livewire.manajemen.rekap.dum', [
            'title' => 'DUM (Data Uang Masuk)',
        ]);
    }
}
