<?php

namespace App\Http\Livewire\Frontend\Orders;

use Livewire\Component;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class Orders extends Component
{

    public function render()
    {
        return view('livewire.frontend.orders.orders', $this->allOrders());
    }

    public function allOrders()
    {
        $order = Order::orderBy('id', 'DESC')->where('id_user', Auth()->id())->get();
        $orderz = [];
        foreach ($order as $item) {
            $orderz[] = DB::table('order_details')
                ->Join(
                    'product_variations',
                    'order_details.id_variasi',
                    '=',
                    'product_variations.id',
                )->Join(
                    'products',
                    'product_variations.id_produk',
                    '=',
                    'products.id',
                )->where('order_details.id_pesanan', '=', $item->id)
                ->get();
        }
        // dd($orderz);
        // dd($order[0]->produk);

        return [
            'orders' => $order,
            'orderz' => $orderz
        ];
    }
}
