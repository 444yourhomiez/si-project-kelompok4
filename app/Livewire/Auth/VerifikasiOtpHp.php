<?php

namespace App\Livewire\Auth;

use App\Notifications\OtpHpNotification;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class VerifikasiOtpHp extends Component
{
    public $otp = '';

    public function mount()
    {
        if (! Auth::check()) {
            return redirect()->route('login');
        }

        $anggota = Auth::user()->anggota;

        if (! $anggota) {
            return redirect()->route('login');
        }

        if ($anggota->no_hp_verified_at) {
            return redirect()->route('menunggu');
        }
    }

    public function verifikasi()
    {
        $this->validate([
            'otp' => 'required|digits:6',
        ], [
            'otp.required' => 'Kode OTP wajib diisi',
            'otp.digits'   => 'Kode OTP harus 6 digit angka',
        ]);

        $anggota = Auth::user()->anggota()->first();

        if (! $anggota->otp_hp || ! $anggota->otp_hp_expires_at) {
            $this->addError('otp', 'OTP belum dikirim. Silakan minta kirim ulang.');
            return;
        }

        if (now()->isAfter($anggota->otp_hp_expires_at)) {
            $this->addError('otp', 'Kode OTP sudah kadaluarsa. Silakan minta kirim ulang.');
            return;
        }

        if ($this->otp !== $anggota->otp_hp) {
            $this->addError('otp', 'Kode OTP tidak valid.');
            return;
        }

        $anggota->update([
            'no_hp_verified_at' => now(),
            'otp_hp'            => null,
            'otp_hp_expires_at' => null,
        ]);

        session()->flash('success', 'Nomor HP berhasil diverifikasi!');
        return redirect()->route('menunggu');
    }

    public function kirimUlang()
    {
        $user    = Auth::user();
        $anggota = $user->anggota()->first();

        $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        $anggota->update([
            'otp_hp'            => $otp,
            'otp_hp_expires_at' => now()->addMinutes(10),
        ]);

        $user->notify(new OtpHpNotification($otp, $anggota->no_hp));

        session()->flash('info', 'OTP baru telah dikirim ke email Anda.');
    }

    public function render()
    {
        $anggota = Auth::user()->anggota;
        return view('livewire.auth.verifikasi-otp-hp', compact('anggota'));
    }
}
