<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use function Flasher\SweetAlert\Prime\sweetalert;

class ProfilePicture extends Component
{
    use WithFileUploads;
    public $profile;

     public function updatedProfile(){
        // dd($this->profile);
        auth()->user()->update([
            'profile_photo' => $this->profile->store('profile-photos', 'public')
        ]);

        sweetalert()->success('Profile picture updated successfully');
     }
    public function render()
    {
        return view('livewire.profile-picture');
    }
}
