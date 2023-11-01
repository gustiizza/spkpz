<?php

namespace App\Policies;

use App\Models\Penerima;
use App\Models\User;

class PenerimaPolicy
{
    public function view(User $user): bool
    {
        return in_array($user->status, ['rz', 'dm']);
    }
}
