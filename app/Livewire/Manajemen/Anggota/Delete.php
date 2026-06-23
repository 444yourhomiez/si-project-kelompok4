<?php
namespace App\Livewire\Manajemen\Anggota;
use App\Models\Anggota;
use Livewire\Component;
class Delete extends Component
{
    public ?int $idDelete = null;

    protected $listeners = ['openDelete'];

    public function openDelete($id)
    {
        $this->idDelete = (int) $id;
        $this->dispatch('showDeleteModal');
    }

    public function delete()
    {
        $anggota = Anggota::find($this->idDelete);
        if ($anggota) {
            $anggota->user?->delete();
        }
        $this->idDelete = null;
        $this->dispatch('refreshAnggota');
        $this->dispatch('closeDeleteModal');
    }

    public function render()
    {
        $anggota = $this->idDelete
            ? Anggota::with('user')->find($this->idDelete)
            : null;
        return view('livewire.manajemen.anggota.delete', compact('anggota'));
    }
}
