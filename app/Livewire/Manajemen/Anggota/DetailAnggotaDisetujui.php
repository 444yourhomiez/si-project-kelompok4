<?php

namespace App\Livewire\Manajemen\Anggota;

use Livewire\Component;
use App\Models\Anggota;

class DetailAnggotaDisetujui extends Component
{
    public $anggota;

    public function mount($id)
    {
        $this->anggota = Anggota::with([

            'user',
            'simpanan'
            // 'pinjaman'

        ])->findOrFail($id);
    }

    public function render()
    {
        return view(
            'livewire.manajemen.anggota.detail-anggota-disetujui',
            [
                'title' => 'Detail Anggota Disetujui'
            ]
        );
    }
}