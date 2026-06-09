<?php

namespace App\Livewire\Manajemen\Anggota;

use Livewire\Component;
use App\Models\Anggota;

class Delete extends Component
{
    public $anggota;

    public $idDelete;

    protected $listeners = [
        'openDelete'
    ];

    // BUKA MODAL
    public function openDelete($id)
    {
        $this->anggota = Anggota::with(
            'user'
        )->findOrFail($id);

        $this->idDelete = $id;
    }

    // HAPUS DATA
    public function delete()
    {
        $anggota = Anggota::find($this->idDelete);

        if ($anggota) {

            // HAPUS USER
            // otomatis anggota ikut kehapus
            // kalau relasi cascade aktif
            $anggota->user?->delete();
        }

        // REFRESH TABLE
        $this->dispatch(
            'refreshAnggota'
        );

        // CLOSE MODAL
        $this->dispatch(
            'closeDeleteModal'
        );
    }

    public function render()
    {
        return view(
            'livewire.manajemen.anggota.delete'
        );
    }
}