<?php
namespace App\Livewire\Pengawas\Anggota;
use App\Models\Anggota;
use Livewire\Component;
class DetailAnggotaDisetujui extends Component
{
    public int $anggotaId;

    public function mount($id)
    {
        $this->anggotaId = (int) $id;
    }

    public function render()
    {
        $anggota = Anggota::with([
            'user',
            'simpanan',
        ])->findOrFail($this->anggotaId);

        return view('livewire.pengawas.anggota.detail-anggota-disetujui', [
            'anggota' => $anggota,
            'title'   => 'Detail Anggota Disetujui',
        ]);
    }
}