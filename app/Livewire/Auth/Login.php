<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Login extends Component
{
    public $email;
    public $password;

    public function login()
    {
        $this->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt([
            'email' => $this->email,
            'password' => $this->password,
        ])) {

            $user = auth()->user();

            // 🔥 ROLE ANGGOTA
            if ($user->role == 'anggota') {

                // 🔴 DITOLAK
                if ($user->status == 'ditolak') {
                    Auth::logout();
                    session()->flash('error', 'Akun Anda ditolak');
                    return;
                }

                // 🟡 MENUNGGU
                if ($user->status == 'menunggu') {
                    return redirect()->route('menunggu');
                }

                // 🟢 DISETUJUI (INI YANG KURANG!)
                if ($user->status == 'disetujui') {
                    return redirect()
                    ->route('anggota.dashboard')
                    ->with('success', 'Selamat anda berhasil login');
                }
            }

            // 🔥 ROLE LAIN
            if ($user->role == 'manajemen') {
                return redirect()
                ->route('manajemen.dashboard')
                ->with('success', 'Selamat anda berhasil login');
            }

            if ($user->role == 'pengawas') {
                return redirect()
                ->route('pengawas.dashboard')
                ->with('success', 'Selamat anda berhasil login');
            }

            // fallback (jaga-jaga)
            return redirect('/');
        }

        session()->flash('error', 'Email atau password salah');
    }

    public function render()
    {
        return view('livewire.auth.login');
    }
}
