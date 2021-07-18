<?php

namespace App\Http\Livewire\Backend\Report;

use Livewire\Component;
use App\Http\Livewire\Backend\Redirec;
use Illuminate\Support\Facades\DB;

class ReportOrders extends Component
{
    public function render()
    {
        $redi = new Redirec();
        $redi->redirec();

        $data = DB::table('order_details')
            ->Join(
                'orders',
                'order_details.id_pesanan',
                '=',
                'orders.id',
            )->Join(
                'product_variations',
                'order_details.id_variasi',
                '=',
                'product_variations.id',
            )->Join(
                'products',
                'product_variations.id_produk',
                '=',
                'products.id',
            )->select(
                'products.nama_produk',
                'product_variations.harga',
                'order_details.qty',
                'orders.tgl_pesan',
            )->orderBy('orders.id', 'DESC')
            ->get();
        // dd($data);
        return view('livewire.backend.report.report-orders', [
            'laporProduk' => $data,
        ]);
    }
}
