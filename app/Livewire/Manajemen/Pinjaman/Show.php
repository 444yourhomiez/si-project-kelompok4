<?php
namespace App\Livewire\Manajemen\Pinjaman;
use App\Models\Cicilan;
use App\Models\Pinjaman;
use App\Models\Simpanan;
use Livewire\Component;
class Show extends Component
{
    public ?int $detailPinjamanId = null;
    public string $catatan = '';
    public string $modalError = '';
    protected $listeners = [
        'openShow',
    ];
    public function openShow($id)
    {
        $this->detailPinjamanId = (int) $id;
        $this->modalError = '';
        $pinjaman = Pinjaman::find($this->detailPinjamanId);
        $this->catatan = $pinjaman?->catatan ?? '';
    }
    public function setujui()
    {
        $pinjaman = Pinjaman::find($this->detailPinjamanId);
        if (! $pinjaman || $pinjaman->status !== 'pending') {
            $this->modalError = 'Hanya pinjaman dengan status pending yang dapat disetujui.';
            return;
        }
        $this->modalError = '';
        $pinjaman->update([
            'status' => 'aktif',
            'catatan' => $this->catatan,
            'tanggal_persetujuan' => now(),
        ]);
        $sudahAdaCicilan = Cicilan::where('pinjaman_id', $pinjaman->id)->exists();
        if (! $sudahAdaCicilan) {
            for ($i = 1; $i <= $pinjaman->tenor; $i++) {
                Cicilan::create([
                    'pinjaman_id'    => $pinjaman->id,
                    'cicilan_ke'     => $i,
                    'jumlah_tagihan' => $pinjaman->cicilan_per_bulan,
                    'jatuh_tempo'    => now()->addMonths($i),
                    'status'         => 'belum',
                ]);
            }

            // Kapitalisasi otomatis masuk ke simpanan sukarela anggota
            if ($pinjaman->kapitalisasi > 0) {
                Simpanan::create([
                    'anggota_id'     => $pinjaman->anggota_id,
                    'jenis_simpanan' => 'sukarela',
                    'jumlah'         => $pinjaman->kapitalisasi,
                    'tanggal'        => now(),
                ]);
            }
        }
        $this->dispatch('closeShowModal');
        $this->dispatch('dataKoperasiUpdated');
    }
    public function tolak()
    {
        $pinjaman = Pinjaman::find($this->detailPinjamanId);
        if (! $pinjaman) return;
        $pinjaman->update([
            'status' => 'ditolak',
            'catatan' => $this->catatan,
        ]);
        $this->dispatch('closeShowModal');
        $this->dispatch('dataKoperasiUpdated');
    }
    public function render()
    {
        $detailPinjaman = $this->detailPinjamanId
            ? Pinjaman::with('anggota')->find($this->detailPinjamanId)
            : null;
        return view('livewire.manajemen.pinjaman.show', compact('detailPinjaman'));
    }
}
