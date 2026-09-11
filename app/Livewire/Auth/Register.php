<?php

namespace App\Livewire\Auth;

use App\Models\Condominium;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.guest')]
class Register extends Component
{
    public Condominium $condominium;

    public string $name = '';

    public string $email = '';

    public string $password = '';

    public string $passwordConfirmation = '';

    public string $tower = '';

    public string $apartmentNumber = '';

    public function mount(Condominium $condominium): void
    {
        $this->condominium = $condominium;
    }

    public function register(): void
    {
        $data = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'string', 'min:8', 'same:passwordConfirmation'],
            'tower' => ['required', 'string', 'max:255'],
            'apartmentNumber' => ['required', 'string', 'max:255'],
        ]);

        $user = User::create([
            'condominium_id' => $this->condominium->id,
            'role' => 'resident',
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'tower' => $data['tower'],
            'apartment_number' => $data['apartmentNumber'],
        ]);

        Auth::login($user);

        request()->session()->regenerate();

        $this->redirectRoute('resident.dashboard', ['condominium' => $this->condominium->slug], navigate: true);
    }

    public function render()
    {
        return view('livewire.auth.register');
    }
}
