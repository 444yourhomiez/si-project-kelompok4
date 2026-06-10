<?php

namespace App\Livewire\Manajemen\Simpanan;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\Simpanan;

class Delete extends Component
{
    public $idDelete;

    public $simpanan;

    #[On('openDelete')]
    public function openDelete($id)
    {
        $this->simpanan = Simpanan::with(
            'anggota'
        )->findOrFail($id);

        $this->idDelete = $id;
    }

    public function delete()
    {
        $simpanan = Simpanan::find($this->idDelete);

        if ($simpanan) {

            $simpanan->delete();
        }

        $this->dispatch(
            'dataKoperasiUpdated'
        );

        $this->dispatch(
            'closeDeleteModal'
        );
    }

    public function render()
    {
        return view(
            'livewire.manajemen.simpanan.delete'
        );
    }
}
