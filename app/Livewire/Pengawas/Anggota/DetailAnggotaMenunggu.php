<?php
namespace App\Livewire\Pengawas\Anggota;
use App\Models\Anggota;
use Livewire\Component;
class DetailAnggotaMenunggu extends Component
{
    public int $anggotaId;

    public function mount(int $id)
    {
        Anggota::findOrFail($id);
        $this->anggotaId = $id;
    }

    public function render()
    {
        $anggota = Anggota::with('user')->findOrFail($this->anggotaId);
        return view('livewire.pengawas.anggota.detail-anggota-menunggu', [
            'anggota' => $anggota,
            'title'   => 'Detail Anggota Menunggu Verifikasi',
        ]);
    }
}
