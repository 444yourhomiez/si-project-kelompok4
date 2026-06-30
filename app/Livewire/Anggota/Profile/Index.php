<?php
namespace App\Livewire\Anggota\Profile;

use Livewire\Component;

class Index extends Component
{
    public function uploadFoto(string $fotoBase64)
    {
        if (! str_starts_with($fotoBase64, 'data:image/')) {
            session()->flash('foto_error', 'File harus berupa gambar.');
            return $this->redirect(route('anggota.profile.index'));
        }

        auth()->user()->update(['foto_profile' => $fotoBase64]);

        session()->flash('foto_success', 'Foto profil berhasil diperbarui.');
        return $this->redirect(route('anggota.profile.index'));
    }

    public function render()
    {
        $user    = auth()->user();
        $fotoUrl = $user->foto_url;

        return view('livewire.anggota.profile.index', [
            'title'   => 'Profile',
            'fotoUrl' => $fotoUrl,
        ]);
    }
}
