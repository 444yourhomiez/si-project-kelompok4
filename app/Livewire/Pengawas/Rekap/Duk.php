<?php

namespace App\Livewire\Pengawas\Rekap;

use Livewire\Component;

class Duk extends Component
{
    public function render()
    {
        return view('livewire.pengawas.rekap.duk', [
            'title' => 'DUK (Data Uang Keluar)',
        ]);
    }
}
