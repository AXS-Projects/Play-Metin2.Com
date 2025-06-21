<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use App\Models\Metin2User;

class Metin2Login extends Component
{
    public $login;
    public $password;
    public $errorMessage;
    public $loggedIn = false;
    public $userLogin;

    public function mount()
    {
        if (session()->has('metin2_user')) {
            $this->loggedIn = true;
            $this->userLogin = session('metin2_user')->login;
        }
    }

    public function login()
    {
        $this->validate([
            'login' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = Metin2User::where('login', $this->login)->first();

        if (!$user) {
            $this->errorMessage = __('messages.auth_username_invalid');
            return;
        }

        if (str_starts_with($user->password, '*')) {
            $validPassword = \App\Support\MySQLPassword::check($this->password, $user->password);
        } else {
            $validPassword = Hash::check($this->password, $user->password);
        }

        if (!$validPassword) {
            $this->errorMessage = __('messages.auth_password_invalid');
            return;
        }

        session(['metin2_user' => $user]);
        $this->loggedIn = true;
        $this->userLogin = $user->login;

        // Resetare formular
        $this->reset(['login', 'password', 'errorMessage']);

        // Anunțăm Livewire că userul s-a autentificat
        $this->emit('userLoggedIn');
    }

    public function logout()
    {
        session()->forget('metin2_user');
        $this->loggedIn = false;
        $this->userLogin = null;
        $this->emit('userLoggedOut');
    }

    public function render()
    {
        return view('livewire.auth.metin2-login');
    }
}
