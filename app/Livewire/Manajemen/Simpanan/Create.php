<?php

namespace App\Livewire\Manajemen\Simpanan;

use Livewire\Component;
use App\Models\Simpanan;
use App\Models\Anggota;

class Create extends Component
{
    protected $listeners = ['openCreate' => 'create'];
    public $anggota_id;
    public $jenis_simpanan;
    public $jumlah;
    public $search = '';
    public $selectedAnggota = null;

    public function resetAnggota()
    {
        $this->selectedAnggota = null;
        $this->anggota_id = null;
        $this->search = '';
    }

    public function pilihAnggota($id, $nama_anggota, $ktp)
    {
        $this->anggota_id = $id;
        $this->search = $nama_anggota . ' - ' . $ktp;
        $this->selectedAnggota = $id;
    }

    public function create()
    {
        $this->selectedAnggota = null;
        $this->search = '';
        $this->reset([
            'anggota_id',
            'jenis_simpanan',
            'jumlah'
        ]);

        $this->resetValidation();
    }

    public function simpan()
    {
        $this->validate([
            'anggota_id' => 'required',
            'jenis_simpanan' => 'required',
            'jumlah' => 'required|numeric|min:100000',
        ], [
            'anggota_id.required' => 'Nama - No KTP Harus Dipilih',
            'jenis_simpanan.required' => 'Jenis Simpanan Harus Dipilih',
            'jumlah.required' => 'Jumlah Wajib Diisi',
            'jumlah.numeric' => 'Jumlah Harus Angka',
            'jumlah.min' => 'Minimal 100.000',
        ]);

        Simpanan::create([
            'anggota_id' => $this->anggota_id,
            'jenis_simpanan' => $this->jenis_simpanan,
            'jumlah' => $this->jumlah,
            'tanggal' => now(),
        ]);

        session()->flash('success', 'Simpanan berhasil ditambahkan');

        $this->reset(['anggota_id', 'jenis_simpanan', 'jumlah']);

        $this->dispatch(
            'dataKoperasiUpdated'
        );

        $this->dispatch('closeCreateModal');
    }

    public function render()
    {
        $anggota = Anggota::with('user')

            ->whereHas('user', function ($q) {
                $q->where('status', 'disetujui');
            })

            ->where(function ($q) {

                $q->where('kode_anggota', 'like', '%' . $this->search . '%')

                    ->orWhere('nama_anggota', 'like', $this->search . '%')

                    ->orWhere('no_ktp', 'like', $this->search . '%');
            })

            ->limit(10)
            ->get();

        return view('livewire.manajemen.simpanan.create', [
            'title' => 'Daftar Simpanan',
            'anggota' => $anggota
        ]);
    }
}
