<?php

namespace App\Livewire\Pengawas\Cicilan;

use App\Models\Pinjaman;
use Livewire\Component;

class Detail extends Component
{
    public int $pinjamanId;

    public function mount(int $id): void
    {
        Pinjaman::findOrFail($id);
        $this->pinjamanId = $id;
    }

    public function render()
    {
        $pinjaman = Pinjaman::with([
            'anggota',
            'cicilan' => fn($q) => $q->orderBy('cicilan_ke'),
        ])->findOrFail($this->pinjamanId);

        return view('livewire.pengawas.cicilan.detail', [
            'title'    => 'Detail Cicilan',
            'pinjaman' => $pinjaman,
        ]);
    }
}
