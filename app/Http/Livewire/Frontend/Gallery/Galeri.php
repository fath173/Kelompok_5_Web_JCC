<?php

namespace App\Http\Livewire\Frontend\Gallery;

use App\Models\Gallery;
use Livewire\Component;

class Galeri extends Component
{


    public function render()
    {
        $galeri = Gallery::orderBy('created_at', 'DESC')->get();;
        // dd($galeri);
        return view('livewire.frontend.gallery.galeri', [
            'gallery' => $galeri,
        ]);
    }
}
