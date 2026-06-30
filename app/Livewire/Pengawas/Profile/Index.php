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

        $user    = auth()->user();
        $mime    = $this->foto->getMimeType();
        $base64  = base64_encode(file_get_contents($this->foto->getRealPath()));
        $dataUrl = "data:{$mime};base64,{$base64}";

        $user->update(['foto_profile' => $dataUrl]);

        session()->flash('foto_success', 'Foto profil berhasil diperbarui.');
        return redirect()->route('pengawas.profile.index');
    }

    public function render()
    {
        $user    = auth()->user();
        $fotoUrl = $user->foto_url;

        return view('livewire.pengawas.profile.index', [
            'title'   => 'Profile',
            'fotoUrl' => $fotoUrl,
        ]);
    }
}
