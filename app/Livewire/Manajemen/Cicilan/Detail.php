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

    public function lunasi(): void
    {
        $pinjaman = Pinjaman::with([
            'cicilan' => fn($q) => $q->where('status', 'belum')->orderBy('cicilan_ke'),
        ])->findOrFail($this->pinjamanId);

        $sisaCicilan = $pinjaman->cicilan;

        if ($sisaCicilan->isEmpty()) {
            session()->flash('error', 'Tidak ada sisa cicilan yang belum dibayar.');
            return;
        }

        $jasaPerBulan  = (int) round(($pinjaman->jumlah_disetujui ?? $pinjaman->jumlah_pengajuan) * ($pinjaman->bunga / 100));
        $pokokPerBulan = $pinjaman->cicilan_per_bulan - $jasaPerBulan;
        $tanggalBayar  = now()->toDateString();

        foreach ($sisaCicilan as $index => $cicilan) {
            $isLast = $index === $sisaCicilan->count() - 1;
            $cicilan->update([
                'status'         => 'lunas',
                'tanggal_bayar'  => $tanggalBayar,
                'jumlah_tagihan' => $isLast ? $cicilan->jumlah_tagihan : $pokokPerBulan,
            ]);
        }

        $pinjaman->update(['status' => 'lunas']);

        $this->dispatch('dataKoperasiUpdated');
        session()->flash('success', 'Pinjaman berhasil dilunasi sepenuhnya.');
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
