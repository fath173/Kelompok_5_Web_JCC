<?php

namespace App\Http\Livewire\Frontend\Carts;

use App\Http\Livewire\Frontend\Redirectt;
use Livewire\Component;
use App\Models\Product_variation as variations;
use Carbon\Carbon;

class Cart extends Component
{

    public $tax = "0%";
    // public $sumQty = [];
    protected $listeners = ['delete'];

    public function render()
    {

        $variations = variations::all();

        $condition = new \Darryldecode\Cart\CartCondition([
            'name' => 'pajak',
            'type' => 'tax',
            'target' => 'total',
            'value' => $this->tax,
            'order' => 1
        ]);

        \Cart::session(Auth()->id())->condition($condition);
        $items = \Cart::session(Auth()->id())->getContent()->sortBy(function ($cart) {
            return $cart->attributes->get('added_at');
        });

        $totalWeight = 0;
        if (\Cart::isEmpty()) {
            $cartData = [];
        } else {
            foreach ($items as $item) {
                $totalWeight += $item->attributes->weight;
                $cart[] = [
                    'rowId' => $item->id,
                    'name' => $item->name,
                    'qty' => $item->quantity,
                    'pricesingle' => $item->price,
                    'price' => $item->getPriceSum(),
                    'attributes' => $item->attributes,
                ];
            }
            // dd($totalWeight);

            $cartData = collect($cart);
        }

        $sub_total = \Cart::session(Auth()->id())->getSubTotal();
        $total = \Cart::session(Auth()->id())->getTotal();

        $newCondition = \Cart::session(Auth()->id())->getCondition('pajak');
        $pajak = $newCondition->getCalculatedValue($sub_total);

        $totalQty = \Cart::session(Auth()->id())->getTotalQuantity();
        $sumQty = [
            'sumQty' => $totalQty
        ];

        $summary = [
            'sub_total' => $sub_total,
            'pajak' => $pajak,
            'total' => $total
        ];
        return view('livewire.frontend.carts.cart', [
            'variations' => $variations,
            'carts' => $cartData,
            'summary' => $summary,
            'sumQty' => $sumQty,
            'sumWeight' => $totalWeight
        ])->with('success', 'Ditambakan ke keranjang!');
    }


    // Method untuk menambahkan variasi ke Cart
    public function addItem($id)
    {
        $rowId = "Cart" . $id;
        $cart = \Cart::session(Auth()->id())->getContent();
        $cekItemId = $cart->whereIn('id', $rowId);

        $idVariation = (substr($rowId, 4, 5));
        $variation = variations::find($idVariation);

        if ($cekItemId->isNotEmpty()) {
            if ($variation->stok == $cekItemId[$rowId]->quantity) {
                session()->flash('error', 'Telah mencapai maksimum stok');
            } else {
                // Alert::question('Question Title', 'Question Message');
                \Cart::session(Auth()->id())->update($rowId, [
                    'quantity' => [
                        'relative' => true,
                        'value' => 1
                    ]
                ]);
                // Alert::success('Sukses!', 'Produk telah ditambahkan ke keranjang');
                $this->emit("swal:modal", [
                    'type'    => 'success',
                    'icon'    => 'success',
                    'title'   => 'Produk telah ditambahkan ke keranjang',
                    'timeout' => 3000,
                ]);
            }
        } else {
            if ($variation->stok == 0) {
                session()->flash('error', 'Stok variasi yang dipilih habis!');
            } else {
                \Cart::session(Auth()->id())->add([
                    'id' => "Cart" . $variation->id,
                    'name' => $variation->product->nama_produk,
                    'price' => $variation->harga,
                    'quantity' => 1,
                    'attributes' => [
                        'added_at' => Carbon::now(),
                        'weight' => $variation->berat,
                        'image' => $variation->product->gambar
                    ],
                ]);
                // Alert::success('Sukses!', 'Produk telah ditambahkan ke keranjang');
                $this->emit("swal:modal", [
                    'type'    => 'success',
                    'icon'    => 'success',
                    'title'   => 'Produk telah ditambahkan ke keranjang',
                    'text'    => "Ingin menghapus produk dari keranjang?",
                    'timeout' => 3000,
                ]);
            }
        }
    }

    // Method untuk menambahkan jumlah QTY pada Cart
    public function increaseItem($rowId)
    {
        $idVariation = (substr($rowId, 4, 5));
        $variation = variations::find($idVariation);

        $cart = \Cart::session(Auth()->id())->getContent();
        $checkItem = $cart->whereIn('id', $rowId);

        if ($variation->stok == $checkItem[$rowId]->quantity) {
            session()->flash('error', 'Telah mencapai maksimum stok');
        } else {
            if ($variation->stok == 0) {
                session()->flash('error', 'Stok variasi yang dipilih habis!');
            } else {
                \Cart::session(Auth()->id())->update($rowId, [
                    'quantity' => [
                        'relative' => true,
                        'value' => 1
                    ]
                ]);
                $this->emit('increaseItem');
            }
        }
    }

    // Method untuk mengurangi jumlah QTY pada Cart
    public function decreaseItem($rowId)
    {
        $idVariation = (substr($rowId, 4, 5));
        $variation = variations::find($idVariation);
        $cart = \Cart::session(Auth()->id())->getContent();
        $checkItem = $cart->whereIn('id', $rowId);
        if ($checkItem[$rowId]->quantity == 1) {
            $this->removeItem($rowId);
        } else {
            \Cart::session(Auth()->id())->update($rowId, [
                'quantity' => [
                    'relative' => true,
                    'value' => -1
                ]
            ]);
            $this->emit('decreaseItem');
        }
    }

    // Method untuk menghapus item pada Cart
    public function removeItem($rowId)
    {
        // dd($rowId);
        // \Cart::session(Auth()->id())->remove($rowId);
        // $this->emit('removeItem');
        $this->emit("swal:confirm", [
            'type'        => 'warning',
            'icon'        => 'warning',
            'title'       => 'Anda Yakin?',
            'text'        => "Ingin menghapus produk dari keranjang?",
            'confirmText' => 'Ya, Hapus',
            'method'      => 'delete',
            'params'      => [$rowId], // optional, send params to success confirmation
            'callback'    => '', // optional, fire event if no confirmed
        ]);
    }

    public function delete($id)
    {
        \Cart::session(Auth()->id())->remove($id);
        $this->emit('removeItem');
    }
}
