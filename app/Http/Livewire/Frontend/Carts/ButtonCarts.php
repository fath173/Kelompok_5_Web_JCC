<?php

namespace App\Http\Livewire\Frontend\Carts;

use Livewire\Component;
use App\Http\Livewire\Frontend\Carts\Cart;

class ButtonCarts extends Component
{
    public $qty;

    protected $listeners = [
        'qtyUpdate' => 'updateCartTotal',
        'increaseItem' => 'updateCartTotal',
        'decreaseItem' => 'updateCartTotal',
        'removeItem' => 'updateCartTotal',
        // 'qtyUpdateAlert' => 'showAlert',
    ];

    public function mount()
    {
        $cart = new Cart;
        // $cart = Cart::get();
        $this->qty = $cart->render()->sumQty;
    }

    public function updateCartTotal()
    {
        $cart = new Cart;
        // $cart = Cart::get();
        $this->qty = $cart->render()->sumQty;
        // Alert::success('Success Title', 'Success Message');
    }

    public function render()
    {
        // Alert::success('Success Title', 'Success Message');
        return view('livewire.frontend.carts.button-carts');
    }
    public function showModal()
    {
        $this->emit('swal:modal', [
            'type'  => 'success',
            'title' => 'Success!!',
            'text'  => "This is a success message",
        ]);
    }

    // public function showAlert()
    // {
    //     Alert::success('Success Title', 'Success Message');
    // }

    public function showConfirmation()
    {
        $this->emit("swal:confirm", [
            'type'        => 'warning',
            'title'       => 'Are you sure?',
            'text'        => "You won't be able to revert this!",
            'confirmText' => 'Yes, delete!',
            'method'      => 'appointments:delete',
            'params'      => [], // optional, send params to success confirmation
            'callback'    => '', // optional, fire event if no confirmed
        ]);
    }
}
