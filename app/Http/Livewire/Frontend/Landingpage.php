<?php

namespace App\Http\Livewire\Frontend;

use App\Models\Order;
use Livewire\Component;
use App\Models\Product;
use App\Models\Testimonial;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class Landingpage extends Component
{
    public function render()
    {
        $products = Product::orderBy('created_at', 'DESC')->get();
        $testi = DB::table('testimonials')
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
            )->where('testimonials.status_baca', '=', 'Yes')
            ->orderBy('testimonials.id', 'DESC')
            ->get();
        $jumlahPelanggan = User::where('level', 'pelanggan')->count();

        $pesananBaru = DB::table('orders')
            ->where('status', '=', 'belum bayar')
            ->orWhere('status', '=', 'verifikasi')
            ->count();
        $semuaPesanan = Order::count();
        $jumlahTestimoni = Testimonial::count();

        // dd($jumlahPelanggan);
        return view('livewire.frontend.landingpage', [
            'products' => $products,
            'testi' => $testi,
            'jumPelanggan' => $jumlahPelanggan,
            'pesananBaru' => $pesananBaru,
            'semuaPesanan' => $semuaPesanan,
            'jumlahTestimoni' => $jumlahTestimoni,
        ]);
    }
}
