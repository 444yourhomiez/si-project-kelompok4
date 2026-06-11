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
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $this->loadUser();
    }

    // =========================
    // AMBIL DATA USER
    // =========================
    public function loadUser()
    {
        $user = User::with('anggota.jadwal')
            ->find(Auth::id());

        if (!$user) {
            $this->user = null;
            $this->status = null;
            $this->anggota = null;
            return;
        }

        $this->user = $user;
        $this->status = $user->status;
        $this->anggota = $user->anggota;
    }

    public function render()
    {
        return view('livewire.auth.menunggu');
    }
}