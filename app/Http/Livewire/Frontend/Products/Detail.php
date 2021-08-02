<?php

namespace App\Http\Livewire\Frontend\Products;

use Livewire\Component;
use App\Models\Product as VariasiModel;
use App\Http\Livewire\Frontend\Carts\Cart;

class Detail extends Component
{

    public $details;
    public $stok = 0;
    protected $listeners = [
        'btnKeranjang' => 'addItems',
    ];
    public function mount($id)
    {
        $this->details = VariasiModel::where('id', $id)->get();

        foreach ($this->details[0]->variasi as $detail) {
            $this->stok += $detail->stok;
        }
    }
    public function render()
    {

        return view('livewire.frontend.products.detail', [
            'details' => $this->details,
            'totalStok' => $this->stok

        ]);
    }

    public function addItems($id)
    {
        if (!Auth()->id()) {

            return redirect()->to('/loginn');
        }
        $this->showModal();
        $this->addItem($id);
    }

    public function addItem($id)
    {
        $cart = new Cart();
        $cart->addItem($id);
        $this->emit('qtyUpdate');
        $this->emit('qtyUpdateAlert');
    }

    public function showModal()
    {
        // alert()->success('SuccessAlert', 'Lorem ipsum dolor sit amet.');
        $this->emit('swal:modal', [
            'type'  => 'success',
            'icon'  => 'success',
            'title' => 'Sukses!',
            'text'  => "Produk telah ditambahkan ke keranjang!",
            'timeout' => 3000
        ]);
    }
}
