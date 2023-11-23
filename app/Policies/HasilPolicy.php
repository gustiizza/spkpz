<?php

namespace App\Policies;

use App\Models\Hasil;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class HasilPolicy
{
    public function view(User $user): bool
    {
        return $user->status === 'op' || $user->status === 'dm' || $user->status === 'rz';
    }
}
