<?php

namespace App\Http\Livewire\Backend\Products;

use Livewire\Component;
use App\Http\Livewire\Backend\Redirec;
use App\Models\Product as ProductModel;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use Illuminate\Http\Request;

class Product extends Component
{
    use WithFileUploads;
    public $nama_produk, $deskripsi;
    public $photo, $photo_mobile;

    protected $listeners = ['resetField', 'deleteProduk'];

    public function tambahProduk(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required|string|max:30',
            'foto_produk' => 'required|image',
            'foto_mobile' => 'required|image',
            'deskripsi' => 'required|string',
        ]);

        $nameImage = md5($request->foto_produk . microtime() . '.' . $request->foto_produk->extension());
        $request->foto_produk->move(public_path('files/product'), $nameImage);
        $nameImage2 = md5($request->foto_mobile . microtime() . '.' . $request->foto_mobile->extension());
        $request->foto_mobile->move(public_path('files/product'), $nameImage2);

        ProductModel::create([
            'nama_produk' => $request->nama_produk,
            'gambar' => $nameImage,
            'gambar_mobile' => $nameImage2,
            'deskripsi' => $request->deskripsi
        ]);
        return redirect('admin-products');
    }

    public function editProduk(Request $request, $id)
    {
        $request->validate([
            'nama_produk' => 'required|string|max:30',
            'foto_produk' => 'image',
            'foto_mobile' => 'image',
            'deskripsi' => 'required|string',
        ]);

        if ($request->foto_produk) {
            $nameImage = md5($request->foto_produk . microtime() . '.' . $request->foto_produk->extension());
            $request->foto_produk->move(public_path('files/product'), $nameImage);
            ProductModel::where('id', $id)
                ->update([
                    'nama_produk' => $request->nama_produk,
                    'gambar' => $nameImage,
                    'deskripsi' => $request->deskripsi,
                ]);
        }
        if ($request->foto_mobile) {
            $nameImage2 = md5($request->foto_mobile . microtime() . '.' . $request->foto_mobile->extension());
            $request->foto_mobile->move(public_path('files/product'), $nameImage2);
            ProductModel::where('id', $id)
                ->update([
                    'nama_produk' => $request->nama_produk,
                    'gambar_mobile' => $nameImage2,
                    'deskripsi' => $request->deskripsi,
                ]);
        } else {
            ProductModel::where('id', $id)
                ->update([
                    'nama_produk' => $request->nama_produk,
                    'deskripsi' => $request->deskripsi,
                ]);
        }

        return redirect('admin-products');
    }

    public function edit($id)
    {
        $produk = ProductModel::find($id);
        $this->nama_produk = $produk->nama_produk;
        $this->deskripsi = $produk->deskripsi;
    }

    public function resetField()
    {
        $this->nama_produk = '';
        $this->photo = '';
        $this->deskripsi = '';
    }

    public function updatedPhoto()
    {
        $this->validate([
            'photo' => 'image|max:1024',
            'photo_mobile' => 'image|max:1024',
        ]);
    }



    public function removeProduk($id)
    {
        $this->emit("swal:confirm", [
            'type'        => 'warning',
            'icon'        => 'warning',
            'title'       => 'Anda Yakin?',
            'text'        => "Ingin menghapus produk?",
            'confirmText' => 'Ya, Hapus',
            'method'      => 'deleteProduk',
            'params'      => [$id], // optional, send params to
            'callback'    => '', // optional, fire event if no
        ]);
    }

    public function deleteProduk($id)
    {
        ProductModel::where('id', $id)
            ->delete();
    }

    public function render()
    {
        // Redirect untuk menahan jika bukan admin maka tidak bisa masuk ke dashboard
        $redi = new Redirec();
        $redi->redirec();

        // Memanggil Product dari database dengan model
        $products = ProductModel::orderBy('created_at', 'DESC')->get();

        return view('livewire.backend.products.product', [
            'products' => $products
        ]);
    }
}

// public function tambahProduk()
//     {
//         $this->validate([
//             'photo' => 'image|max:1024|required',
//             'nama_produk' => 'required:max:15',
//             'deskripsi' => 'required',
//         ]);


//         $namePhoto = md5($this->photo . microtime() . '.' . $this->photo->extension());
//         Storage::putFileAs(
//             'public/product',
//             $this->photo,
//             $namePhoto
//         );

//         ProductModel::create([
//             'nama_produk' => $this->nama_produk,
//             'gambar' => $namePhoto,
//             'deskripsi' => $this->deskripsi
//         ]);

//         $this->resetField();
//         $this->emit("swal:modal", [
//             'type'    => 'success',
//             'icon'    => 'success',
//             'title'   => 'Produk berhasil ditambahkan!',
//             'timeout' => 3000,
//         ]);
//     }


// public function updateProduk($id)
//     {
//         if ($this->photo) {
//             $this->validate([
//                 'photo' => 'image|max:1024|required',
//                 'nama_produk' => 'required:max:15',
//                 'deskripsi' => 'required',
//             ]);
//             $namePhoto = md5($this->photo . microtime() . '.' . $this->photo->extension());
//             Storage::putFileAs(
//                 'public/product',
//                 $this->photo,
//                 $namePhoto
//             );

//             ProductModel::where('id', $id)
//                 ->update([
//                     'nama_produk' => $this->nama_produk,
//                     'gambar' => $namePhoto,
//                     'deskripsi' => $this->deskripsi,
//                 ]);
//             $this->photo = '';
//         } else if ($this->photo_mobile) {
//             $this->validate([
//                 'photo_mobile' => 'image|max:1024|required',
//                 'nama_produk' => 'required:max:15',
//                 'deskripsi' => 'required',
//             ]);
//             $namePhoto = md5($this->photo_mobile . microtime() . '.' . $this->photo_mobile->extension());
//             Storage::putFileAs(
//                 'public/product',
//                 $this->photo_mobile,
//                 $namePhoto
//             );

//             ProductModel::where('id', $id)
//                 ->update([
//                     'nama_produk' => $this->nama_produk,
//                     'gambar_mobile' => $namePhoto,
//                     'deskripsi' => $this->deskripsi,
//                 ]);
//             $this->photo_mobile = '';
//         } else {
//             $this->validate([
//                 'nama_produk' => 'required:max:15',
//                 'deskripsi' => 'required',
//             ]);
//             ProductModel::where('id', $id)
//                 ->update([
//                     'nama_produk' => $this->nama_produk,
//                     'deskripsi' => $this->deskripsi,
//                 ]);
//         }
//     }
