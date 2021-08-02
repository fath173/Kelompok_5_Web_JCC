<?php

namespace App\Http\Livewire\Frontend\Orders;

use Livewire\Component;
use App\Models\Order;

class PurchaseOrders extends Component
{
    public function render()
    {
        return view('livewire.frontend.orders.purchase-orders');
    }

    public function orders()
    {
        $orders = Order::where('id', $this->id_orders)->get();
        return $orders;
    }
}
