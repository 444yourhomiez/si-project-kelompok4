<?php

namespace App\Livewire\Pengawas\Anggota;

use Livewire\Component;
use App\Models\Anggota;

class DetailAnggotaMenunggu extends Component
{
    public ?Anggota $anggota = null;

    public function mount(int $id)
    {
        $this->anggota = Anggota::with([
            'user'
        ])->findOrFail($id);
    }

    public function render()
    {
        return view('livewire.pengawas.anggota.detail-anggota-menunggu', [
            'title' => 'Detail Anggota Menunggu Verifikasi',
        ]);
    }
}