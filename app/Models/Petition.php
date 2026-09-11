<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['condominium_id', 'created_by', 'title', 'type', 'content', 'pdf_path', 'status', 'published_at', 'deadline_at'])]
class Petition extends Model
{
    protected function casts(): array
    {
        return [
            'published_at' => 'datetime',
            'deadline_at' => 'datetime',
        ];
    }

    public function condominium(): BelongsTo
    {
        return $this->belongsTo(Condominium::class);
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function signatures(): HasMany
    {
        return $this->hasMany(PetitionSignature::class);
    }

    public function isPublished(): bool
    {
        return $this->published_at === null || $this->published_at->isPast();
    }

    public function isPastDeadline(): bool
    {
        return $this->deadline_at !== null && $this->deadline_at->isPast();
    }

    public function isOpen(): bool
    {
        return $this->status === 'open'
            && $this->isPublished()
            && ! $this->isPastDeadline();
    }

    public function effectiveStatusLabel(): string
    {
        return match (true) {
            ! $this->isPublished() => 'Agendado',
            $this->status === 'closed' => 'Encerrado',
            $this->isPastDeadline() => 'Prazo encerrado',
            default => 'Aberto',
        };
    }

    public function effectiveStatusColor(): string
    {
        return match (true) {
            ! $this->isPublished() => 'gray',
            $this->status === 'closed' => 'danger',
            $this->isPastDeadline() => 'warning',
            default => 'success',
        };
    }

    public function isSignedBy(?User $user): bool
    {
        if (! $user) {
            return false;
        }

        return $this->signatures()->where('user_id', $user->id)->exists();
    }
}
