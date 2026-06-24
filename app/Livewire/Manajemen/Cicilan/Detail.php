<?php

namespace App\Livewire\Manajemen\Cicilan;

use App\Models\Cicilan;
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

    public function bayar(int $id): void
    {
        $cicilan = Cicilan::findOrFail($id);

        if ($cicilan->status === 'lunas') {
            session()->flash('error', 'Cicilan ini sudah lunas.');
            return;
        }

        $cicilan->update(['status' => 'lunas', 'tanggal_bayar' => now()]);

        $sisa = Cicilan::where('pinjaman_id', $cicilan->pinjaman_id)
            ->where('status', 'belum')
            ->count();

        if ($sisa === 0) {
            Pinjaman::find($cicilan->pinjaman_id)?->update(['status' => 'lunas']);
        }

        $this->dispatch('dataKoperasiUpdated');
        session()->flash('success', 'Cicilan ke-' . $cicilan->cicilan_ke . ' berhasil ditandai lunas.');
    }

    public function render()
    {
        $pinjaman = Pinjaman::with([
            'anggota',
            'cicilan' => fn($q) => $q->orderBy('cicilan_ke'),
        ])->findOrFail($this->pinjamanId);

        return view('livewire.manajemen.cicilan.detail', [
            'title'    => 'Detail Cicilan',
            'pinjaman' => $pinjaman,
        ]);
    }
}
