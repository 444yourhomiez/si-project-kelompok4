<?php
namespace App\Livewire\Manajemen\Simpanan;
use App\Models\Simpanan;
use Livewire\Component;
class Delete extends Component
{
    public ?int $idDelete = null;

    protected $listeners = ['openDelete'];

    public function openDelete($id)
    {
        $this->idDelete = (int) $id;
    }

    public function delete()
    {
        $simpanan = Simpanan::find($this->idDelete);
        if ($simpanan) {
            $simpanan->delete();
        }
        $this->idDelete = null;
        $this->dispatch('dataKoperasiUpdated');
        $this->dispatch('closeDeleteModal');
    }

    public function render()
    {
        $simpanan = $this->idDelete
            ? Simpanan::with('anggota')->find($this->idDelete)
            : null;
        return view('livewire.manajemen.simpanan.delete', compact('simpanan'));
    }
}
