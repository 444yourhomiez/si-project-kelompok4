<?php
namespace App\Livewire\Pengawas\Profile;

use Livewire\Component;
use Livewire\WithFileUploads;

class Index extends Component
{
    use WithFileUploads;

    public $foto;

    public function updatedFoto()
    {
        $this->validate([
            'foto' => 'image|max:2048',
        ], [
            'foto.image' => 'File harus berupa gambar.',
            'foto.max'   => 'Ukuran gambar maksimal 2MB.',
        ]);
    }

    public function batalFoto()
    {
        $this->foto = null;
    }

    public function uploadFoto()
    {
        $this->validate([
            'foto' => 'required|image|max:2048',
        ], [
            'foto.required' => 'Pilih gambar terlebih dahulu.',
            'foto.image'    => 'File harus berupa gambar.',
            'foto.max'      => 'Ukuran gambar maksimal 2MB.',
        ]);

        $user = auth()->user();

        if ($user->foto_profile) {
            $oldPath = storage_path('app/public/' . $user->foto_profile);
            if (file_exists($oldPath)) {
                unlink($oldPath);
            }
        }

        $path = $this->foto->store('profiles', 'public');
        $user->update(['foto_profile' => $path]);

        session()->flash('foto_success', 'Foto profil berhasil diperbarui.');
        return redirect()->route('pengawas.profile.index');
    }

    public function render()
    {
        return view('livewire.pengawas.profile.index');
    }
}
