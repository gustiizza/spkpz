<?php

namespace App\Policies;

use App\Models\Perhitungan;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PerhitunganPolicy
{
    public function view(User $user): bool
    {
        return $user->status == 'dm';
    }
}
