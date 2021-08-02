<?php

namespace App\Http\Livewire\Backend\Orders;

// use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use App\Http\Livewire\Backend\Redirec;
use App\Models\Order_detail;
use App\Models\Product_variation as variations;

class OrderAdmin extends Component
{
    public $alasan_tolak;

    public function render()
    {
        $redi = new Redirec();
        $redi->redirec();

        return view('livewire.backend.orders.order-admin', $this->allOrders());
    }

    public function allOrders()
    {
        $order = Order::orderBy('id', 'DESC')->get();
        foreach ($order as $item) {
            $orderz[] = [DB::table('order_details')
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
                ->get()];
        }
        // dd($order[]->bukti_bayar);

        return [
            'orders' => $order,
            'orderz' => $orderz
        ];
    }

    public function cancelOrder($id)
    {
        $this->validate([
            'alasan_tolak' => 'required',
        ]);
        $data = Order_detail::where('id_pesanan', $id)->get();
        foreach ($data as $item) {
            $variation = variations::find($item['id_variasi']);
            $variation->increment('stok', $item['qty']);
        }
        Order::where('id', $id)
            ->update([
                'status' => 'dibatalkan',
                'alasan' => $this->alasan_tolak,
            ]);
    }
    public function verifikasi($id)
    {
        Order::where('id', $id)
            ->update([
                'status' => 'sudah bayar',
            ]);
    }
    public function sendOrder($id)
    {
        Order::where('id', $id)
            ->update([
                'status' => 'sedang dikirim',
            ]);
    }
}
