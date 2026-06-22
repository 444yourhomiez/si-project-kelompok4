<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Menunggu extends Component
{
    public $status;
    public $user;
    public $anggota;
    public $emailTerverifikasi  = false;
    public $hpTerverifikasi     = false;

    public function mount()
    {
        if (! Auth::check()) {
            return redirect()->route('login');
        }
        $this->loadUser();
    }

    public function checkStatus()
    {
        if (! Auth::check()) {
            return redirect()->route('login');
        }
        $this->loadUser();
    }

    public function loadUser()
    {
        $user = User::with('anggota.jadwal')->find(Auth::id());

        if (! $user) {
            $this->user    = null;
            $this->status  = null;
            $this->anggota = null;
            return;
        }

        $this->user                 = $user;
        $this->status               = $user->status;
        $this->anggota              = $user->anggota;
        $this->emailTerverifikasi   = $user->hasVerifiedEmail();
        $this->hpTerverifikasi      = $user->anggota?->no_hp_verified_at !== null;
    }

    public function kirimUlangEmail()
    {
        $user = Auth::user();

        if ($user->hasVerifiedEmail()) {
            return;
        }

        $user->sendEmailVerificationNotification();
        session()->flash('info', 'Email verifikasi telah dikirim ulang. Cek inbox Anda.');
    }

    public function render()
    {
        return view('livewire.auth.menunggu');
    }
}
