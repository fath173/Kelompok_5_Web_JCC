<?php

namespace App\Http\Livewire\Frontend\Carts;

use Livewire\Component;
use App\Http\Livewire\Frontend\Carts\Cart;
use App\Http\Livewire\Frontend\Ongkir\DataOngkir;
use App\Models\Product_variation as variations;
use App\Models\User;
use App\Models\Order;
use App\Models\Order_detail;

class Checkout extends Component
{
    public $ongkir, $total, $keterangan;
    public $name, $address;
    protected $listeners = [
        'btnBuatPesanan' => 'inputData'
    ];
    public function inputData($ongkir, $total, $keterangan)
    {
        $this->ongkir = $ongkir;
        $this->total = $total;
        $this->keterangan = $keterangan;
        try {
            $this->validate([
                'ongkir' => 'required',
                'total' => 'required',
                'keterangan' => 'required'
            ]);

            $allCart = \Cart::session(Auth()->id())->getContent();
            $filterCart = $allCart->map(function ($item) {
                return [
                    'id' => substr($item->id, 4, 5),
                    'quantity' => $item->quantity,
                    'price' => $item->getPriceSum(),
                ];
            });
            foreach ($filterCart as $cart) {
                $variation = variations::find($cart['id']);

                if ($variation->stok === 0) {
                    return session()->flash('error', 'Stok 0 yahh');
                }

                $variation->decrement('stok', $cart['quantity']);
            }

            date_default_timezone_set('Asia/Jakarta');
            $waktu = date('Y-m-d H:i:s');

            $id = Order::insertGetId([
                'id_user' => Auth()->id(),
                'tgl_pesan' => $waktu,
                'ongkir' => $ongkir, // INI PERLU DIKIRIM DATANYA
                'status' => 'belum bayar',
                'total' => $total,
                'keterangan' => $keterangan,
                'alamat_kirim' => $this->address
            ]);

            foreach ($filterCart as $cart) {
                Order_detail::create([
                    'id_pesanan' => $id,
                    'id_variasi' => $cart['id'],
                    'qty' => $cart['quantity'],
                    'subtotal' => $cart['price'],
                ]);
            }

            \Cart::session(Auth()->id())->clear();
            return redirect()->to('/orders');
        } catch (\Throwable $th) {
            // return $th;
            return session()->flash('error', 'Silahkan Pilih Ongkir Terlebih Dahulu!');
        }
    }
    public function render()
    {

        $user = User::find(Auth()->id());
        $this->name = $user['name'];
        $this->address = $user['address'];
        $district = $user['district'];

        $cart = new Cart;
        $carts = $cart->render()->carts;
        $summary = $cart->render()->summary;
        $sumWeight = $cart->render()->sumWeight;


        if (\Cart::isEmpty()) {
            echo "<script>alert('Cart Kosong bosquu');location='/products'</script>";
            // return redirect('/products');
        } else {
            $ongkos = new DataOngkir;
            $ongkos->ongkir($district, $sumWeight);
            $result = $ongkos->render()->result;
            return view('livewire.frontend.carts.checkout', [
                'carts' => $carts,
                'summary' => $summary,
                'ongkirs' => $result
            ]);
        }
    }
}
