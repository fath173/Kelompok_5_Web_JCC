<?php

namespace App\Http\Livewire\Backend\Pelanggan;

use Livewire\Component;
use App\Http\Livewire\Backend\Redirec;
use App\Models\User;

class Pelanggan extends Component
{



    public function render()
    {
        $redi = new Redirec();
        $redi->redirec();

        //ini coding untuk memanggil data daari database
        $dataPelanggan = User::where('level', 'pelanggan')->orderBy('id', 'DESC')->get();

        return view('livewire.backend.pelanggan.pelanggan', [
            'dataPelanggan' => $dataPelanggan
        ]);
    }
}
