<?php
namespace App\Livewire\Auth;

use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Livewire\Component;

class ResetPassword extends Component
{
    public string $token = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';
    public string $errorMessage = '';

    public function mount(string $token): void
    {
        $this->token = $token;
        $this->email = request('email', '');
    }

    public function simpan()
    {
        $this->errorMessage = '';

        $this->validate([
            'email'                 => 'required|email',
            'password'              => 'required|min:8|confirmed',
            'password_confirmation' => 'required',
        ], [
            'email.required'                 => 'Email wajib diisi',
            'email.email'                    => 'Format email tidak valid',
            'password.required'              => 'Password wajib diisi',
            'password.min'                   => 'Password minimal 8 karakter',
            'password.confirmed'             => 'Konfirmasi password tidak cocok',
            'password_confirmation.required' => 'Konfirmasi password wajib diisi',
        ]);

        $status = Password::reset(
            [
                'email'                 => $this->email,
                'password'              => $this->password,
                'password_confirmation' => $this->password_confirmation,
                'token'                 => $this->token,
            ],
            function ($user) {
                $user->forceFill([
                    'password'       => Hash::make($this->password),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            session()->flash('success', 'Password berhasil direset. Silakan login dengan password baru.');
            return redirect()->route('login');
        }

        $this->errorMessage = match ($status) {
            Password::INVALID_TOKEN   => 'Link reset password tidak valid atau sudah kedaluwarsa (berlaku 3 menit). Silakan minta link baru.',
            Password::INVALID_USER    => 'Email tidak ditemukan dalam sistem.',
            Password::RESET_THROTTLED => 'Terlalu banyak percobaan. Silakan tunggu sebentar.',
            default                   => 'Gagal mereset password. Silakan coba lagi.',
        };
    }

    public function render()
    {
        return view('livewire.auth.reset-password');
    }
}
