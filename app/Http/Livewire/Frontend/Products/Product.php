<?php

namespace App\Http\Livewire\Frontend\Products;

use Livewire\Component;

use App\Models\Product as ProductModel;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class Product extends Component
{
    use WithFileUploads;
    public $nama_produk, $gambar, $deskripsi;

    public function render()
    {
        $products = ProductModel::orderBy('created_at', 'DESC')->get();
        return view('livewire.frontend.products.product', [
            'products' => $products
        ]);
    }

    public function previewImage()
    {
        $this->validate([
            'gambar' => 'image|max:2048'
        ]);
    }

    public function store()
    {
        $this->validate([
            'nama_produk' => 'required|max:15',
            'gambar' => 'image|max:2048|required',
            'deskripsi' => 'required'
        ]);

        $namaGambar = md5($this->gambar . microtime() . '.' . $this->gambar->extension());

        Storage::putFileAs(
            'public/images',
            $this->gambar,
            $namaGambar
        );

        ProductModel::create([
            'nama_produk' => $this->nama_produk,
            'gambar' => $namaGambar,
            'deskripsi' => $this->deskripsi
        ]);

        session()->flash('info', 'Product Created Sukses');
        $this->nama_produk = '';
        $this->gambar = '';
        $this->deskripsi = '';
    }
}
