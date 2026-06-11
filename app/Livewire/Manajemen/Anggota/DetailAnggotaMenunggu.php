<?php

namespace App\Livewire\Manajemen\Anggota;

use Livewire\Component;
use App\Models\Anggota;

class DetailAnggotaMenunggu extends Component
{
    public ?Anggota $anggota = null;

    public function mount(int $id)
    {
        $this->anggota = Anggota::with([
            'user'
        ])->findOrFail($id);
    }

    // SETUJUI
    public function setujui()
    {
        // AMBIL KODE TERAKHIR
        $lastAnggota = Anggota::whereNotNull('kode_anggota')
            ->orderByRaw('CAST(SUBSTRING(kode_anggota, 3) AS UNSIGNED) DESC')
            ->first();

        $number = 1;

        if ($lastAnggota) {

            $lastNumber = (int) str_replace(
                'A-',
                '',
                $lastAnggota->kode_anggota
            );

            $number = $lastNumber + 1;
        }

        // GENERATE KODE
        $kodeAnggota = 'A-' . str_pad(
            $number,
            6,
            '0',
            STR_PAD_LEFT
        );

        // UPDATE DATA ANGGOTA
        $this->anggota->update([

            'kode_anggota' => $kodeAnggota

        ]);

        // UPDATE STATUS USER
        $this->anggota->user->update([

            'status' => 'disetujui'

        ]);

        $this->dispatch('refreshAnggota');

        session()->flash(
            'success',
            'Anggota berhasil disetujui'
        );

        return redirect()->route(
            'manajemen.anggota.disetujui'
        );
    }

    // TOLAK
    public function tolak()
    {
        $user = $this->anggota->user;

        // hapus anggota dulu
        $this->anggota->delete();

        // baru user
        $user?->delete();

        $this->dispatch('refreshAnggota');

        session()->flash(
            'success',
            'Pengajuan anggota ditolak dan data berhasil dihapus'
        );

        return redirect()->route(
            'manajemen.anggota.menunggu'
        );
    }
}
