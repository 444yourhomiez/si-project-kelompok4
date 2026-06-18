<?php
namespace App\Livewire\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
class Login extends Component
{
    public $email;
    public $password;
    public function login()
    {
        $this->validate([
            // EMAIL
            'email' => 'required|email|regex:/^[a-zA-Z0-9._%+-]+@gmail\.com$/',
            // PASSWORD
            'password' => 'required',
        ], [
            // EMAIL
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Email yang Anda masukkan tidak sesuai',
            'email.regex' => 'Email yang Anda masukkan tidak sesuai',
            // PASSWORD
            'password.required' => 'Password wajib diisi',
        ]);
        // CEK EMAIL
        $user = User::where(
            'email',
            $this->email
        )->first();
        if (! $user) {
            $this->addError(
                'email',
                'Email tidak terdaftar'
            );
            return;
        }
        // CEK PASSWORD
        if (! Hash::check(
            $this->password,
            $user->password
        )) {
            $this->addError(
                'password',
                'Password yang Anda masukkan salah'
            );
            return;
        }
        Auth::login($user);
        // ROLE ANGGOTA
        if ($user->role == 'anggota') {
            if ($user->status == 'ditolak') {
                Auth::logout();
                $this->addError(
                    'email',
                    'Akun Anda ditolak'
                );
                return;
            }
            if ($user->status == 'menunggu') {
                return redirect()->route('menunggu');
            }
            if ($user->status == 'disetujui') {
                return redirect()
                    ->route('anggota.dashboard')
                    ->with(
                        'success',
                        'Selamat anda berhasil login'
                    );
            }
        }
        // ROLE MANAJEMEN
        if ($user->role == 'manajemen') {
            return redirect()
                ->route('manajemen.dashboard')
                ->with(
                    'success',
                    'Selamat anda berhasil login'
                );
        }
        // ROLE PENGAWAS
        if ($user->role == 'pengawas') {
            return redirect()
                ->route('pengawas.dashboard')
                ->with(
                    'success',
                    'Selamat anda berhasil login'
                );
        }
        return redirect('/');
    }
    public function render()
    {
        return view('livewire.auth.login');
    }
}
