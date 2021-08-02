<?php

namespace App\Http\Livewire\Backend;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Redirec extends Component
{

    public function redirec()
    {
        if (Auth::user()->level == 'pelanggan') {
            return redirect()->to('/');
        }
    }
}
