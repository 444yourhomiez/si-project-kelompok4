<?php

namespace App\Livewire\Anggota\Profile;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UbahPassword extends Component
{
    public $current_password;

    public $password;

    public $password_confirmation;

    protected $rules = [

        'current_password' => 'required',

        'password' => 'required|min:8|confirmed',

    ];

    protected $messages = [

        'current_password.required' =>
        'Password lama wajib diisi',

        'password.required' =>
        'Password baru wajib diisi',

        'password.min' =>
        'Password minimal 8 karakter',

        'password.confirmed' =>
        'Konfirmasi password tidak cocok',

    ];

    public function updatePassword()
    {
        $this->validate();

        // PASSWORD LAMA SALAH
        if (!Hash::check(
            $this->current_password,
            Auth::user()->password
        )) {

            $this->addError(
                'current_password',
                'Password lama tidak sesuai'
            );

            return;
        }

        // AMBIL USER
        $user = User::find(
            auth()->id()
        );

        // UPDATE PASSWORD
        if ($user) {

            $user->password = Hash::make(
                $this->password
            );

            $user->save();
        }

        // RESET
        $this->reset([
            'current_password',
            'password',
            'password_confirmation'
        ]);

        // CLOSE MODAL
        $this->dispatch(
            'closeUbahPasswordAnggotaModal'
        );
    }

    public function render()
    {
        return view(
            'livewire.anggota.profile.ubah-password'
        );
    }
}
