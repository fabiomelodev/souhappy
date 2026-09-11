<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

#[Fillable(['name', 'slug'])]
class Condominium extends Model
{
    protected $table = 'condominiums';

    protected static function booted(): void
    {
        static::creating(function (Condominium $condominium): void {
            if (blank($condominium->slug)) {
                $condominium->slug = static::generateUniqueSlug($condominium->name);
            }
        });
    }

    public static function generateUniqueSlug(string $name): string
    {
        $base = Str::slug($name);
        $slug = $base;
        $suffix = 1;

        while (static::where('slug', $slug)->exists()) {
            $slug = "{$base}-".++$suffix;
        }

        return $slug;
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function petitions(): HasMany
    {
        return $this->hasMany(Petition::class);
    }
}
