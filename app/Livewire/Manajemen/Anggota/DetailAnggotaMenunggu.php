<?php

namespace App\Livewire\Manajemen\Anggota;

use App\Models\Anggota;
use App\Models\Simpanan;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class DetailAnggotaMenunggu extends Component
{
    public int $anggotaId;

    public function mount(int $id)
    {
        Anggota::findOrFail($id);
        $this->anggotaId = $id;
    }

    public function setujui()
    {
        $anggota = Anggota::with('user')->findOrFail($this->anggotaId);

        DB::transaction(function () use ($anggota) {
            $lastAnggota = Anggota::whereNotNull('kode_anggota')
                ->lockForUpdate()
                ->orderByRaw('CAST(SUBSTRING(kode_anggota, 3) AS UNSIGNED) DESC')
                ->first();

            $number = $lastAnggota
                ? (int) str_replace('A-', '', $lastAnggota->kode_anggota) + 1
                : 1;

            $anggota->update([
                'kode_anggota' => 'A-' . str_pad($number, 6, '0', STR_PAD_LEFT),
            ]);

            $anggota->user->update(['status' => 'disetujui']);

            Simpanan::create([
                'anggota_id'     => $anggota->id,
                'jenis_simpanan' => 'pokok',
                'jumlah'         => 500000,
                'tanggal'        => now(),
            ]);

            Simpanan::create([
                'anggota_id'     => $anggota->id,
                'jenis_simpanan' => 'wajib',
                'jumlah'         => 50000,
                'tanggal'        => now(),
            ]);

            Simpanan::create([
                'anggota_id'     => $anggota->id,
                'jenis_simpanan' => 'sukarela',
                'jumlah'         => 100000,
                'tanggal'        => now(),
            ]);
        });

        $this->dispatch('refreshAnggota');
        session()->flash('success', 'Anggota berhasil disetujui');
        return redirect()->route('manajemen.anggota.disetujui');
    }

    public function tolak()
    {
        $anggota = Anggota::with('user')->findOrFail($this->anggotaId);

        $anggota->user?->update(['status' => 'ditolak']);

        $this->dispatch('refreshAnggota');
        session()->flash('success', 'Pengajuan anggota telah ditolak. Anggota akan melihat pemberitahuan penolakan.');
        return redirect()->route('manajemen.anggota.menunggu');
    }

    public function render()
    {
        $anggota = Anggota::with('user')->findOrFail($this->anggotaId);
        return view('livewire.manajemen.anggota.detail-anggota-menunggu', compact('anggota'));
    }
}
