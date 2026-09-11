<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

#[Fillable(['petition_id', 'user_id', 'full_name', 'tower', 'apartment_number', 'signature_path', 'ip_address', 'signed_at'])]
class PetitionSignature extends Model
{
    protected function casts(): array
    {
        return [
            'signed_at' => 'datetime',
        ];
    }

    public function petition(): BelongsTo
    {
        return $this->belongsTo(Petition::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function signatureAbsolutePath(): string
    {
        return Storage::disk('public')->path($this->signature_path);
    }
}
