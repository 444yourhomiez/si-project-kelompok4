<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class Menunggu extends Component
{
    public $status;
    public $user;
    public $anggota;

    // =========================
    // LOAD AWAL
    // =========================
    public function mount()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $this->loadUser();
    }

    // =========================
    // AUTO REFRESH (REALTIME)
    // =========================
    public function checkStatus()
    {
        $this->loadUser();

        // 🔥 paksa Livewire re-render
        $this->dispatch('$refresh');
    }

    // =========================
    // AMBIL DATA USER
    // =========================
    public function loadUser()
    {
        $user = User::with('anggota.jadwal')->find(Auth::id());

        if (!$user) {
            return;
        }

        // 🔥 paksa refresh dari DB
        $user->refresh();

        $this->user = $user;
        $this->status = $user->status;
        $this->anggota = $user->anggota;
    }

    public function render()
    {
        return view('livewire.auth.menunggu');
    }
}