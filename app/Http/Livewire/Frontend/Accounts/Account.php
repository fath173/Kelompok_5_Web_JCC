<?php

namespace App\Http\Livewire\Frontend\Accounts;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class Account extends Component
{


    use WithFileUploads;
    public $user_id;
    public $name, $username, $phone_number, $email, $birthday, $gender, $image, $images;
    public $password_old, $password_new, $confirm_password;

    protected $listeners = ['resetField'];

    public function render()
    {
        $user = User::find(Auth()->id());
        // $this->province = $user->province;
        // $this->district = $user->district;
        // $this->address = $user->address;

        return view('livewire.frontend.accounts.account', [
            'user' => $user,
        ]);
    }

    public function resetField()
    {
        $this->user_id = '';
        $this->name = '';
        // $this->username = '';
        $this->phone_number = '';
        $this->email = '';
        $this->gender = '';
        $this->address = '';
        $this->image = '';
        $this->password_old = '';
        $this->password_new = '';
        $this->confirm_password = '';
    }

    public function cancel()
    {
        $this->resetField();
    }

    public function edit()
    {
        $user = User::find(Auth()->id());
        $this->user_id = $user->id;
        $this->name = $user->name;
        // $this->username = $user->username;
        $this->phone_number = $user->phone_number;
        $this->email = $user->email;
        $this->birthday = $user->birthday;
        $this->gender = $user->gender;
        $this->address = $user->address;
    }

    public function previewImage()
    {
        $this->validate([
            'image' => 'image|max:2048'
        ]);
    }

    public function updateImage()
    {
        $this->validate([
            'image' => 'image|max:2048|required',
        ]);
        $nameImage = md5($this->image . microtime() . '.' . $this->image->extension());
        Storage::putFileAs(
            'public/img-users',
            $this->image,
            $nameImage
        );
        User::where('id', $this->user_id)
            ->update([
                'image' => $nameImage
            ]);
    }


    public function updateBio()
    {
        $this->validate([
            'name' => 'required',
            // 'username' => 'required',
            'birthday' => 'required|date',
            'gender' => 'required',
        ]);

        User::where('id', $this->user_id)
            ->update([
                'name' => $this->name,
                // 'username' => $this->username,
                'birthday' => $this->birthday,
                'gender' => $this->gender,
            ]);

        // $this->resetField();
    }

    public function updateContact()
    {
        $this->validate([
            'email' => 'required|email',
            'phone_number' => 'required|numeric',
        ]);

        User::where('id', $this->user_id)
            ->update([
                'email' => $this->email,
                'phone_number' => $this->phone_number
            ]);
        // $this->resetField();
    }

    public function updatePassword()
    {
        $this->validate([
            'password_old' => 'required',
            'password_new' => 'required|min:8',
            'confirm_password' => 'required|same:password_new',
        ]);

        $user = User::find($this->user_id);
        if (!Hash::check($this->password_old, $user->password)) {
            $this->emit("swal:modal", [
                'type'    => 'danger',
                'icon'    => 'error',
                'title'   => 'Masukkan password lama anda dengan benar!',
                'timeout' => 3000,
            ]);
        } else {
            User::where('id', $this->user_id)
                ->update([
                    'password' => Hash::make($this->confirm_password),
                ]);

            $this->resetField();
            $this->emit("swal:modal", [
                'type'    => 'success',
                'icon'    => 'success',
                'title'   => 'Password Anda Telah Berhasil Diperbarui.',
                'timeout' => 3000,
            ]);
        }
    }
}
