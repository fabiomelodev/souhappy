<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.guest')]
class Login extends Component
{
    public string $email = '';

    public string $password = '';

    public function authenticate(): void
    {
        $credentials = $this->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        if (! Auth::attempt($credentials)) {
            $this->addError('email', 'E-mail ou senha inválidos.');

            return;
        }

        request()->session()->regenerate();

        $condominium = Auth::user()->condominium;

        if (! $condominium) {
            Auth::logout();
            $this->addError('email', 'Sua conta ainda não está vinculada a um condomínio.');

            return;
        }

        $this->redirectRoute('resident.dashboard', ['condominium' => $condominium->slug], navigate: true);
    }

    public function render()
    {
        return view('livewire.auth.login');
    }
}
