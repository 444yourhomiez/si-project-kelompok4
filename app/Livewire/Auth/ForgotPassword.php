<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Password;
use Livewire\Component;

class ForgotPassword extends Component
{
    public $email = '';
    public $terkirim = false;

    public function kirim()
    {
        $this->validate([
            'email' => 'required|email',
        ], [
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
        ]);

        $status = Password::sendResetLink(['email' => $this->email]);

        if ($status === Password::RESET_LINK_SENT) {
            $this->terkirim = true;
        } else {
            $this->addError('email', 'Email tidak terdaftar atau tidak ditemukan.');
        }
    }

    public function render()
    {
        return view('livewire.auth.forgot-password');
    }
}
