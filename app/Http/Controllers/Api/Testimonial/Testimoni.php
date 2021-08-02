<?php

namespace App\Http\Controllers\Api\Testimonial;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Testimoni extends Controller
{
    public function index()
    {
        // $testi = Testimonial::orderBy('id', 'DESC')->get();
        $tes = DB::table('testimonials')
            ->Join(
                'users',
                'testimonials.id_user',
                '=',
                'users.id',
            )->select(
                'users.name',
                'users.image',
                'testimonials.tgl_testi',
                'testimonials.kesan'
            )->orderBy('testimonials.id', 'DESC')
            ->get();

        return response()->json([
            'message' => 'Success ambil testimoni',
            'dataTesti' => $tes,
        ]);
    }
}
