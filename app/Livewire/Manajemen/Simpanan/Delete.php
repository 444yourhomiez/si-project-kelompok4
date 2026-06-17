<?php
namespace App\Livewire\Manajemen\Simpanan;
use App\Models\Simpanan;
use Livewire\Component;
class Delete extends Component
{
    protected $listeners = [
        'openDelete',
    ];
    public $idDelete;
    public $simpanan;
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
        $this->reset([
            'simpanan',
            'idDelete',
        ]);
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
