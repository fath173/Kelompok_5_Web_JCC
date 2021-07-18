<?php

namespace App\Http\Livewire\Backend\Testimonial;

use Livewire\Component;
use App\Http\Livewire\Backend\Redirec;
use App\Models\Testimonial;
use Illuminate\Support\Facades\DB;

class Testimoni extends Component
{

    public function render()
    {
        $redi = new Redirec();
        $redi->redirec();

        //ini coding untuk memanggil data daari database
        $dataTestimoni = DB::table('testimonials')
            ->Join(
                'users',
                'testimonials.id_user',
                '=',
                'users.id',
            )->select(
                'users.name',
                'users.image',
                'testimonials.id',
                'testimonials.tgl_testi',
                'testimonials.kesan',
                'testimonials.status_baca'
            )->orderBy('testimonials.id', 'DESC')
            ->get();
        // dd($dataTestimoni);
        return view('livewire.backend.testimonial.testimoni', [
            'dataTestimoni' => $dataTestimoni
        ]);
    }

    public function blokir($id)
    {
        Testimonial::where('id', $id)
            ->update([
                'status_baca' => 'No'
            ]);
    }
    public function bukaBlokir($id)
    {
        Testimonial::where('id', $id)
            ->update([
                'status_baca' => 'Yes'
            ]);
    }
}
