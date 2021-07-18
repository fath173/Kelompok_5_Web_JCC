<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;
use Auth;

class Login extends Component
{
    public $form = [
        'email' => '',
        'password' => '',
    ];

    public $msg = '';

    public function submit()
    {
        $this->validate([
            'form.email' => 'required|email',
            'form.password' => 'required',
        ]);

        $check = Auth::attempt($this->form, false);
        if ($check) {
            return redirect()->route('/');
        }

        session()->flash('message', [
            'message' => 'Incorrect email or password',
            'color' => 'danger',
        ]);
    }
    public function render()
    {
        return view('livewire.auth.login');
    }
}
