<?php

namespace App\Livewire\Manajemen\Rekap;

use App\Models\RekapHarian;
use Livewire\Component;

class Edit extends Component
{
    protected $listeners = ['editRekap' => 'buka'];

    public int    $rekapId    = 0;
    public string $jenis      = '';
    public string $nominal    = '';
    public string $keterangan = '';

    public function buka(int $id): void
    {
        $rekap = RekapHarian::findOrFail($id);
        $this->rekapId     = $rekap->id;
        $this->jenis       = $rekap->jenis;
        $this->nominal     = (string) $rekap->nominal;
        $this->keterangan  = $rekap->keterangan;
        $this->resetValidation();
        $this->dispatch('openEditRekapModal');
    }

    public function simpan(): void
    {
        $this->validate([
            'jenis'      => 'required|in:uang_masuk,uang_keluar',
            'nominal'    => 'required|numeric|min:1000|max:999999999',
            'keterangan' => 'required|string|max:255',
        ], [
            'jenis.required'      => 'Jenis transaksi wajib dipilih.',
            'jenis.in'            => 'Jenis transaksi tidak valid.',
            'nominal.required'    => 'Nominal wajib diisi.',
            'nominal.numeric'     => 'Nominal harus berupa angka.',
            'nominal.min'         => 'Nominal minimal Rp 1.000.',
            'nominal.max'         => 'Nominal maksimal Rp 999.999.999.',
            'keterangan.required' => 'Keterangan wajib diisi.',
            'keterangan.max'      => 'Keterangan maksimal 255 karakter.',
        ]);

        RekapHarian::findOrFail($this->rekapId)->update([
            'jenis'      => $this->jenis,
            'nominal'    => $this->nominal,
            'keterangan' => $this->keterangan,
        ]);

        $this->dispatch('rekapUpdated');
        $this->dispatch('closeEditRekapModal');
    }

    public function render()
    {
        return view('livewire.manajemen.rekap.edit');
    }
}
