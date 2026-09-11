<?php

namespace App\Livewire\Petitions;

use App\Models\Condominium;
use App\Models\Petition;
use App\Models\PetitionSignature;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.resident')]
class Show extends Component
{
    public Condominium $condominium;

    public Petition $petition;

    public string $fullName = '';

    public string $tower = '';

    public string $apartmentNumber = '';

    public function mount(Condominium $condominium, Petition $petition): void
    {
        abort_unless($petition->condominium_id === $condominium->id, 404);
        abort_unless($petition->isPublished(), 404);

        $this->condominium = $condominium;
        $this->petition = $petition;

        $user = Auth::user();
        $this->fullName = $user->name;
        $this->tower = (string) $user->tower;
        $this->apartmentNumber = (string) $user->apartment_number;
    }

    public function sign(string $signatureDataUrl): void
    {
        abort_unless($this->petition->isOpen(), 403);

        if ($this->petition->isSignedBy(Auth::user())) {
            $this->addError('signature', 'Você já assinou este abaixo-assinado.');

            return;
        }

        $this->validate([
            'fullName' => ['required', 'string', 'max:255'],
            'tower' => ['required', 'string', 'max:255'],
            'apartmentNumber' => ['required', 'string', 'max:255'],
        ]);

        if (! preg_match('/^data:image\/png;base64,/', $signatureDataUrl)) {
            $this->addError('signature', 'Assinatura inválida. Desenhe sua assinatura antes de confirmar.');

            return;
        }

        $binary = base64_decode(preg_replace('/^data:image\/png;base64,/', '', $signatureDataUrl));

        $path = "signatures/{$this->petition->id}/".Str::uuid().'.png';
        Storage::disk('public')->put($path, $binary);

        PetitionSignature::create([
            'petition_id' => $this->petition->id,
            'user_id' => Auth::id(),
            'full_name' => $this->fullName,
            'tower' => $this->tower,
            'apartment_number' => $this->apartmentNumber,
            'signature_path' => $path,
            'ip_address' => request()->ip(),
            'signed_at' => now(),
        ]);

        $this->petition->refresh();
    }

    public function render()
    {
        return view('livewire.petitions.show', [
            'signed' => $this->petition->isSignedBy(Auth::user()),
            'signatures' => $this->petition->signatures()->latest('signed_at')->get(),
            'pdfUrl' => $this->petition->type === 'pdf'
                ? Storage::disk('public')->url($this->petition->pdf_path)
                : null,
        ]);
    }
}
