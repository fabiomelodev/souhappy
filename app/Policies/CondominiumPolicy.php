<?php

namespace App\Policies;

use App\Models\Condominium;
use App\Models\User;

class CondominiumPolicy
{
    public function view(User $user, Condominium $condominium): bool
    {
        return $user->isSuperAdmin() || $user->condominium_id === $condominium->id;
    }

    public function create(User $user): bool
    {
        return $user->condominium_id === null;
    }

    public function update(User $user, Condominium $condominium): bool
    {
        if ($user->isSuperAdmin()) {
            return true;
        }

        return $user->isCouncilMember() && $user->condominium_id === $condominium->id;
    }
}
