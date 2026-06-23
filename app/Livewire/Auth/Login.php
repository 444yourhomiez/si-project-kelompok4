<?php
namespace App\Livewire\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Livewire\Component;
class Login extends Component
{
    public $email;
    public $password;
    public function login()
    {
        $key = 'login:' . strtolower($this->email ?? '') . '|' . request()->ip();
        if (RateLimiter::tooManyAttempts($key, 5)) {
            $seconds = RateLimiter::availableIn($key);
            $this->addError('email', "Terlalu banyak percobaan login. Coba lagi dalam {$seconds} detik.");
            return;
        }
        $this->validate([
            'email'    => 'required|email|regex:/^[a-zA-Z0-9._%+-]+@gmail\.com$/',
            'password' => 'required',
        ], [
            'email.required'  => 'Email wajib diisi',
            'email.email'     => 'Email yang Anda masukkan tidak sesuai',
            'email.regex'     => 'Email yang Anda masukkan tidak sesuai',
            'password.required' => 'Password wajib diisi',
        ]);
        $user = User::where('email', $this->email)->first();
        if (! $user) {
            RateLimiter::hit($key, 60);
            $this->addError('email', 'Email tidak terdaftar');
            return;
        }
        if (! Hash::check($this->password, $user->password)) {
            RateLimiter::hit($key, 60);
            $this->addError('password', 'Password yang Anda masukkan salah');
            return;
        }
        RateLimiter::clear($key);
        Auth::login($user);
        // ROLE ANGGOTA
        if ($user->role == 'anggota') {
            if ($user->status == 'ditolak') {
                Auth::logout();
                $this->addError('email', 'Akun Anda ditolak');
                return;
            }
            if ($user->status == 'menunggu') {
                return redirect()->route('menunggu');
            }
            if ($user->status == 'disetujui') {
                return redirect()->route('anggota.dashboard')
                    ->with('success', 'Selamat anda berhasil login');
            }
            Auth::logout();
            $this->addError('email', 'Status akun tidak valid. Hubungi admin.');
            return;
        }
        // ROLE MANAJEMEN
        if ($user->role == 'manajemen') {
            return redirect()->route('manajemen.dashboard')
                ->with('success', 'Selamat anda berhasil login');
        }
        // ROLE PENGAWAS
        if ($user->role == 'pengawas') {
            return redirect()->route('pengawas.dashboard')
                ->with('success', 'Selamat anda berhasil login');
        }
        Auth::logout();
        $this->addError('email', 'Role akun tidak dikenali. Hubungi admin.');
    }
    public function render()
    {
        return view('livewire.auth.login');
    }
}
