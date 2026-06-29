<?php
namespace App\Livewire\Anggota\Profile;

use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Index extends Component
{
    use WithFileUploads;

    public $foto;

    private function storageDisk(): string
    {
        return config('filesystems.default') === 's3' ? 's3' : 'public';
    }

    public function updatedFoto()
    {
        $this->validate([
            'foto' => 'image|max:5120',
        ], [
            'foto.image' => 'File harus berupa gambar.',
            'foto.max'   => 'Ukuran gambar maksimal 5MB.',
        ]);
    }

    public function batalFoto()
    {
        $this->foto = null;
    }

    public function uploadFoto()
    {
        $this->validate([
            'foto' => 'required|image|max:5120',
        ], [
            'foto.required' => 'Pilih gambar terlebih dahulu.',
            'foto.image'    => 'File harus berupa gambar.',
            'foto.max'      => 'Ukuran gambar maksimal 5MB.',
        ]);

        $user = auth()->user();
        $disk = $this->storageDisk();

        if ($user->foto_profile) {
            Storage::disk($disk)->delete($user->foto_profile);
        }

        $path = $this->foto->store('profiles', $disk);
        $user->update(['foto_profile' => $path]);

        session()->flash('foto_success', 'Foto profil berhasil diperbarui.');
        return redirect()->route('anggota.profile.index');
    }

    public function render()
    {
        $user     = auth()->user();
        $disk     = $this->storageDisk();
        $fotoUrl  = $user->foto_profile
            ? Storage::disk($disk)->url($user->foto_profile)
            : null;

        return view('livewire.anggota.profile.index', [
            'title'   => 'Profile',
            'fotoUrl' => $fotoUrl,
        ]);
    }
}
