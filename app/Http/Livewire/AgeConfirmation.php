<?php

namespace App\Http\Livewire;

use Livewire\Component;

class AgeConfirmation extends Component
{
    public function render()
    {
        if (session()->get('ageconfirmation')) {
            return view('livewire.empty');
        }
        return view('livewire.age-confirmation');
    }
}
