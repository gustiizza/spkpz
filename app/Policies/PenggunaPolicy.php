<?php

namespace App\Policies;

use App\Models\User;

class PenggunaPolicy
{
    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user): bool
    {
        return $user->status == 'op';
    }
}
