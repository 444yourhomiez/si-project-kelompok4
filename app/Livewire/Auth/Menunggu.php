<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Menunggu extends Component
{
    public string $status = '';
    public bool $emailTerverifikasi  = false;
    public bool $hpTerverifikasi     = false;

    public function mount()
    {
        if (! Auth::check()) {
            return redirect()->route('login');
        }
        $this->loadStatus();
    }

    public function checkStatus()
    {
        if (! Auth::check()) {
            return redirect()->route('login');
        }
        $this->loadStatus();
        if ($this->status === 'disetujui') {
            return redirect()->route('anggota.dashboard');
        }
    }

    private function loadStatus()
    {
        $user = User::find(Auth::id());
        if (! $user) {
            $this->status = '';
            return;
        }
        $this->status             = $user->status;
        $this->emailTerverifikasi = $user->hasVerifiedEmail();
        $this->hpTerverifikasi    = $user->anggota?->no_hp_verified_at !== null;
    }

    public function kirimUlangEmail()
    {
        $user = Auth::user();
        if ($user->hasVerifiedEmail()) {
            return;
        }
        $user->sendEmailVerificationNotification();
        session()->flash('info', 'Email verifikasi telah dikirim ulang. Cek inbox Anda.');
        $this->loadStatus();
    }

    public function render()
    {
        $user    = Auth::user();
        $anggota = null;
        if ($user) {
            $anggota = User::with('anggota.jadwal')->find($user->id)?->anggota;
        }
        return view('livewire.auth.menunggu', compact('anggota', 'user'));
    }
}
