<?php

namespace App\Livewire\Petitions;

use App\Models\Condominium;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.resident')]
class Index extends Component
{
    public Condominium $condominium;

    public function mount(Condominium $condominium): void
    {
        $this->condominium = $condominium;
    }

    public function render()
    {
        $petitions = $this->condominium->petitions()
            ->where(fn ($query) => $query->whereNull('published_at')->orWhere('published_at', '<=', now()))
            ->withCount('signatures')
            ->latest()
            ->get()
            ->map(fn ($petition) => [
                'petition' => $petition,
                'signed' => $petition->isSignedBy(Auth::user()),
            ]);

        return view('livewire.petitions.index', [
            'petitions' => $petitions,
        ]);
    }
}
