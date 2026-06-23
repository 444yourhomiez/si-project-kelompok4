<?php

namespace App\Livewire\Manajemen\Rekap;

use App\Models\RekapHarian;
use Livewire\Component;

class Create extends Component
{
    protected $listeners = ['openCreateRekap' => 'buka'];

    public string $jenis = '';
    public string $nominal = '';
    public string $keterangan = '';

    public function buka()
    {
        $this->reset(['jenis', 'nominal', 'keterangan']);
        $this->resetValidation();
    }

    public function simpan()
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

        RekapHarian::create([
            'user_id'    => auth()->id(),
            'jenis'      => $this->jenis,
            'nominal'    => $this->nominal,
            'keterangan' => $this->keterangan,
            'tanggal'    => today(),
        ]);

        session()->flash('success', 'Rekapitulasi harian berhasil ditambahkan.');
        $this->reset(['jenis', 'nominal', 'keterangan']);
        $this->dispatch('rekapUpdated');
        $this->dispatch('closeCreateRekapModal');
    }

    public function render()
    {
        return view('livewire.manajemen.rekap.create');
    }
}
