<?php

namespace App\Http\Livewire\Backend\Gallery;

use App\Models\Gallery;
use Livewire\Component;
use App\Http\Livewire\Backend\Redirec;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;

class Galeri extends Component
{
    use WithFileUploads;
    public $judul_gambar, $tgl_gambar, $photo, $deskripsi; // variabel untuk menyimpan data sementara (konsep Livewire)
    protected $listeners = ['resetField', 'deleteFoto']; // Event Listener dari Livewire, untuk resetfield dan Delete Foto

    // Awal Fungsi input data ke database
    public function tambahFoto()
    {
        $this->validate([
            'photo' => 'image|max:1024|required',
            'judul_gambar' => 'required:max:15',
            'tgl_gambar' => 'required|date',
            'deskripsi' => 'required',
        ]);


        $namePhoto = md5($this->photo . microtime() . '.' . $this->photo->extension());
        Storage::putFileAs(
            'public/gallery',
            $this->photo,
            $namePhoto
        );

        Gallery::create([
            'judul_gambar' => $this->judul_gambar,
            'gambar' => $namePhoto,
            'tgl_gambar' => $this->tgl_gambar,
            'deskripsi' => $this->deskripsi,
        ]);
        $this->swallSucces('Foto berhasil ditambahkan');
        $this->resetField();
    }
    // Akhir Fungsi input data ke database

    // Awal Fungsi Update data ke database
    public function edit($id)
    {
        $galeri = Gallery::find($id);
        $this->judul_gambar = $galeri->judul_gambar;
        $this->tgl_gambar = $galeri->tgl_gambar;
        // $this->photo = $galeri->gambar;
        $this->deskripsi = $galeri->deskripsi;
    }

    public function updateFoto($id)
    {
        if ($this->photo) {
            $this->validate([
                'photo' => 'image|max:1024|required',
                'judul_gambar' => 'required:max:15',
                'tgl_gambar' => 'required|date',
                'deskripsi' => 'required',
            ]);
            $namePhoto = md5($this->photo . microtime() . '.' . $this->photo->extension());
            Storage::putFileAs(
                'public/gallery',
                $this->photo,
                $namePhoto
            );

            Gallery::where('id', $id)
                ->update([
                    'judul_gambar' => $this->judul_gambar,
                    'gambar' => $namePhoto,
                    'tgl_gambar' => $this->tgl_gambar,
                    'deskripsi' => $this->deskripsi,
                ]);

            $this->photo = '';
            $this->swallSucces('Data foto berhasil diperbarui');
        } else {
            $this->validate([
                'judul_gambar' => 'required:max:15',
                'tgl_gambar' => 'required|date',
                'deskripsi' => 'required',
            ]);

            Gallery::where('id', $id)
                ->update([
                    'judul_gambar' => $this->judul_gambar,
                    'tgl_gambar' => $this->tgl_gambar,
                    'deskripsi' => $this->deskripsi,
                ]);

            $this->swallSucces('Data Foto berhasil diperbarui');
        }
    }
    // Akhir Fungsi Update data ke database

    // Awal Fungsi Delete data ke database
    public function removeFoto($id)
    {
        $this->emit("swal:confirm", [
            'type'        => 'warning',
            'icon'        => 'warning',
            'title'       => 'Anda Yakin?',
            'text'        => "Ingin menghapus Foto?",
            'confirmText' => 'Ya, Hapus',
            'method'      => 'deleteFoto',
            'params'      => [$id], // optional, send params to
            'callback'    => '', // optional, fire event if no
        ]);
    }

    public function deleteFoto($id)
    {
        Gallery::where('id', $id)
            ->delete();
    }
    // Akhir Fungsi Delete data ke database

    // Awal Fungsi menampilkan Alert success -
    // setelah Input atau Update data berhasil ke database
    public function swallSucces($isi)
    {
        $this->emit("swal:modal", [
            'type'    => 'success',
            'icon'    => 'success',
            'title'   => $isi,
            'timeout' => 3000,
        ]);
    }
    // Akhir Fungsi Menampilkan Alert Success

    // Awal Fungsi mengosongkan Variabel menyimpan sementara untuk input atau update (konsep Livewire)
    public function resetField()
    {
        $this->judul_gambar = '';
        $this->photo = '';
        $this->tgl_gambar = '';
        $this->deskripsi = '';
    }
    // Akhir Fungsi mengosongkan Variabel

    // Mengirim Data ke view galeri untuk ditampilkan
    public function render()
    {
        $redi = new Redirec();
        $redi->redirec();


        $gallery = Gallery::orderBy('created_at', 'DESC')->get();

        return view('livewire.backend.gallery.galeri', [
            'gallery' => $gallery
        ]);
    }
    // Akhir mengirim data ke view
}
