<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CookiesAgreement extends Component
{
    public function render()
    {
        if (session()->get('cookieAgreement')) {
            return view('livewire.empty');
        }
        return view('livewire.cookies-agreement');
    }
}
