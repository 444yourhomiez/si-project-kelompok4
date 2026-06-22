<?php
namespace App\Livewire\Manajemen\Pinjaman;
use App\Models\Cicilan;
use App\Models\Pinjaman;
use Livewire\Component;
class Show extends Component
{
    public $detailPinjaman;
    public $catatan = '';
    protected $listeners = [
        'openShow',
    ];
    public function openShow($id)
    {
        $this->detailPinjaman =
            Pinjaman::with('anggota')
                ->findOrFail($id);
        $this->catatan =
            $this->detailPinjaman->catatan ?? '';
    }
    public function setujui()
    {
        if ($this->detailPinjaman->status !== 'pending') {
            session()->flash('error', 'Hanya pinjaman dengan status pending yang dapat disetujui.');
            $this->dispatch('closeShowModal');
            return;
        }

        $this->detailPinjaman->update([
            'status' => 'aktif',
            'catatan' => $this->catatan,
            'tanggal_persetujuan' => now(),
        ]);
        $sudahAdaCicilan = Cicilan::where(
            'pinjaman_id',
            $this->detailPinjaman->id
        )->exists();
        if (! $sudahAdaCicilan) {
            for (
                $i = 1;
                $i <= $this->detailPinjaman->tenor;
                $i++
            ) {
                Cicilan::create([
                    'pinjaman_id' => $this->detailPinjaman->id,
                    'cicilan_ke' => $i,
                    'jumlah_tagihan' => $this->detailPinjaman->cicilan_per_bulan,
                    'jatuh_tempo' => now()->addMonths($i),
                    'status' => 'belum',
                ]);
            }
        }
        $this->dispatch('closeShowModal');
        $this->dispatch('dataKoperasiUpdated');
        session()->flash(
            'success',
            'Pinjaman berhasil disetujui'
        );
    }
    public function tolak()
    {
        $this->detailPinjaman->update([
            'status' => 'ditolak',
            'catatan' => $this->catatan,
        ]);
        $this->dispatch('closeShowModal');
        $this->dispatch('dataKoperasiUpdated');
        session()->flash(
            'success',
            'Pinjaman berhasil ditolak'
        );
    }
    public function render()
    {
        return view(
            'livewire.manajemen.pinjaman.show'
        );
    }
}
