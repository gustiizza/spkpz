<?php

namespace App\Policies;

use App\Models\User;

class PenggunaPolicy
{
    public function view(User $user): bool
    {
        return $user->status == 'op';
    }
}
