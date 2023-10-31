<?php

namespace App\Policies;

use App\Models\Kriteria;
use App\Models\User;

class KriteriaPolicy
{
    public function view(User $user): bool
    {
        return $user->status == 'op';
    }
}
