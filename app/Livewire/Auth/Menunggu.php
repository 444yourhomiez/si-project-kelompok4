<?php

namespace App\Livewire\Auth;

use App\Models\Anggota;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Menunggu extends Component
{
    public string $status = '';
    public bool $emailTerverifikasi  = false;

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
    }

    public function goToLogin()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect()->route('login')
            ->with('success', 'Pendaftaran Anda disetujui! Silakan login untuk melanjutkan.');
    }

    public function konfirmasiTolak()
    {
        /** @var User $user */
        $user    = Auth::user();
        /** @var Anggota|null $anggota */
        $anggota = $user?->anggota;

        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        if ($anggota) $anggota->delete();
        if ($user)    $user->delete();

        return redirect()->route('homepage');
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
    }

    public function kirimUlangEmail()
    {
        /** @var User $user */
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
