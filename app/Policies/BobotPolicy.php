<?php

namespace App\Policies;

use App\Models\Bobot;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class BobotPolicy
{
    public function view(User $user): bool
    {
        return $user->status == 'dm';
    }
}
