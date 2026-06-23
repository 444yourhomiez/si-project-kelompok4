<?php
namespace App\Livewire\Manajemen\Anggota;
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
            'pinjaman' => fn($q) => $q->with([
                'cicilan' => fn($cq) => $cq->orderBy('cicilan_ke'),
            ])->orderBy('created_at', 'desc'),
        ])->findOrFail($this->anggotaId);

        return view('livewire.manajemen.anggota.detail-anggota-disetujui', [
            'anggota' => $anggota,
            'title'   => 'Detail Anggota Disetujui',
        ]);
    }
}