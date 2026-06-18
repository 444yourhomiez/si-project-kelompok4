<?php
namespace App\Livewire\Manajemen\Profile;
use Livewire\Component;
class Index extends Component
{
    public function render()
    {
        return view('livewire.manajemen.profile.index', [
            'title' => 'Profile',
        ]);
    }
}
