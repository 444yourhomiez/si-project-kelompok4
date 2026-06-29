<?php

namespace App\Livewire\Manajemen\Cicilan;

use App\Models\Cicilan;
use App\Models\Pinjaman;
use Livewire\Component;

class Detail extends Component
{
    public int  $pinjamanId;
    public ?int $confirmCicilanId = null;
    public int  $confirmCicilanKe = 0;
    public bool $confirmLunasi    = false;

    public function mount(int $id): void
    {
        Pinjaman::findOrFail($id);
        $this->pinjamanId = $id;
    }

    public function konfirmBayar(int $id): void
    {
        $cicilan = Cicilan::findOrFail($id);
        $this->confirmCicilanId = $id;
        $this->confirmCicilanKe = $cicilan->cicilan_ke;
    }

    public function batalKonfirmasi(): void
    {
        $this->confirmCicilanId = null;
        $this->confirmCicilanKe = 0;
    }

    public function konfirmLunasi(): void
    {
        $this->confirmLunasi = true;
    }

    public function batalLunasi(): void
    {
        $this->confirmLunasi = false;
    }

    public function bayar(): void
    {
        if (! $this->confirmCicilanId) return;

        $cicilan = Cicilan::findOrFail($this->confirmCicilanId);

        if ($cicilan->status === 'lunas') {
            $this->batalKonfirmasi();
            $this->dispatch('swal', icon: 'error', title: 'Gagal', text: 'Cicilan ini sudah lunas.');
            return;
        }

        $ke = $cicilan->cicilan_ke;

        $cicilan->update(['status' => 'lunas', 'tanggal_bayar' => now()]);

        $sisa = Cicilan::where('pinjaman_id', $cicilan->pinjaman_id)
            ->where('status', 'belum')
            ->count();

        if ($sisa === 0) {
            Pinjaman::find($cicilan->pinjaman_id)?->update(['status' => 'lunas']);
        }

        $this->batalKonfirmasi();
        $this->dispatch('dataKoperasiUpdated');
        $this->dispatch('swal',
            icon: 'success',
            title: 'Pembayaran Berhasil!',
            text: 'Cicilan ke-' . $ke . ' berhasil ditandai lunas.',
        );
    }

    public function lunasi(): void
    {
        $this->confirmLunasi = false;

        $pinjaman = Pinjaman::with([
            'cicilan' => fn($q) => $q->where('status', 'belum')->orderBy('cicilan_ke'),
        ])->findOrFail($this->pinjamanId);

        $sisaCicilan = $pinjaman->cicilan;

        if ($sisaCicilan->isEmpty()) {
            $this->dispatch('swal', icon: 'error', title: 'Gagal', text: 'Tidak ada sisa cicilan yang belum dibayar.');
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
        $this->dispatch('swal',
            icon: 'success',
            title: 'Pelunasan Berhasil!',
            text: 'Semua cicilan pinjaman berhasil dilunasi.',
        );
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
