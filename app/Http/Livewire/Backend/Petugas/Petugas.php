<?php

namespace App\Http\Livewire\Backend\Petugas;

use Livewire\Component;
use App\Http\Livewire\Backend\Redirec;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\WithFileUploads;

class Petugas extends Component
{
    use WithFileUploads;
    public $name, $phone_number, $email, $password, $password_confirmation,
        $gender, $address;

    public function tambahPetugas()
    {
        $this->validate([
            'name' => 'required',
            'phone_number' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8',
            'password_confirmation' => 'required_with:password|same:password|min:8',
            'gender' => 'required',
            'address' => 'required',
        ]);
        date_default_timezone_set('Asia/Jakarta');
        $waktu = date('Y-m-d H:i:s');

        User::create([
            'name' => $this->name,
            'phone_number' => $this->phone_number,
            'email' => $this->email,
            'email_verified_at' => $waktu,
            'password' => Hash::make($this->password_confirmation),
            'level' => 'pegawai',
            'gender' => $this->gender,
            'address' => $this->address,
        ]);


        $this->resetField();
        $this->emit("swal:modal", [
            'type'    => 'success',
            'icon'    => 'success',
            'title'   => 'Petugas berhasil ditambahkan!',
            'timeout' => 3000,
        ]);
    }

    public function render()
    {
        $redi = new Redirec();
        $redi->redirec();

        //ini coding untuk memanggil data daari database
        $dataPetugas = User::where('level', 'admin')->orderBy('id', 'DESC')->get();

        return view('livewire.backend.petugas.petugas', [
            'dataPetugas' => $dataPetugas
        ]);
    }
}
