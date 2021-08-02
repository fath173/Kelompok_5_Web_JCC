<?php

namespace App\Http\Livewire\Backend\Products;

use Livewire\Component;
use App\Models\Product as VariasiModel;
use App\Models\Product_variation as Variasi;

class ProductVariation extends Component
{
    // public $details;
    public $id_produk, $nama_variasi, $berat, $stok, $harga;

    protected $listeners = ['resetField', 'deleteVariasi'];

    public function mount($id)
    {
        $this->id_produk = $id;
    }

    public function tambahVariasi()
    {
        $this->validate([
            'id_produk' => 'required',
            'nama_variasi' => 'required:max:10',
            'berat' => 'required',
            'stok' => 'required',
            'harga' => 'required',
        ]);

        Variasi::create([
            'id_produk' => $this->id_produk,
            'nama_variasi' => $this->nama_variasi,
            'berat' => $this->berat,
            'stok' => $this->stok,
            'harga' => $this->harga,
        ]);
        $this->resetField();
        $this->emit("swal:modal", [
            'type'    => 'success',
            'icon'    => 'success',
            'title'   => 'Berhasil menambahkan variasi!',
            'timeout' => 3000,
        ]);
    }

    public function edit($id)
    {
        $details = Variasi::find($id);
        // dd($details);
        $this->nama_variasi = $details->nama_variasi;
        $this->berat = $details->berat;
        $this->stok = $details->stok;
        $this->harga = $details->harga;
    }


    public function resetField()
    {
        $this->nama_variasi = '';
        $this->berat = '';
        $this->stok = '';
        $this->harga = '';
    }

    public function updateVariasi($id)
    {
        $this->validate([
            'nama_variasi' => 'required:max:10',
            'berat' => 'required',
            'stok' => 'required',
            'harga' => 'required',
        ]);
        Variasi::where('id', $id)
            ->update([
                'nama_variasi' => $this->nama_variasi,
                'berat' => $this->berat,
                'stok' => $this->stok,
                'harga' => $this->harga,
            ]);
    }

    public function removeVariasi($id)
    {
        $this->emit("swal:confirm", [
            'type'        => 'warning',
            'icon'        => 'warning',
            'title'       => 'Anda Yakin?',
            'text'        => "Ingin menghapus Variasi?",
            'confirmText' => 'Ya, Hapus',
            'method'      => 'deleteVariasi',
            'params'      => [$id], // optional, send params to
            'callback'    => '', // optional, fire event if no
        ]);
    }

    public function deleteVariasi($id)
    {
        Variasi::where('id', $id)
            ->delete();
    }

    public function render()
    {
        $details = VariasiModel::where('id', $this->id_produk)->get();

        return view('livewire.backend.products.product-variation', [
            'details' => $details,
        ]);
    }
}
