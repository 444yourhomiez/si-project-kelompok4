<?php

namespace App\Livewire\Pengawas\Pinjaman;

use App\Models\Pinjaman;
use Livewire\Component;

class Show extends Component
{
    public ?int $detailPinjamanId = null;

    protected $listeners = ['openShow'];

    public function openShow(int $id): void
    {
        $this->detailPinjamanId = $id;
    }

    public function render()
    {
        $detailPinjaman = $this->detailPinjamanId
            ? Pinjaman::with('anggota')->find($this->detailPinjamanId)
            : null;

        return view('livewire.pengawas.pinjaman.show', compact('detailPinjaman'));
    }
}
