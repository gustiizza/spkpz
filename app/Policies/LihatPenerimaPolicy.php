<?php

namespace App\Policies;

use App\Models\LihatPenerima;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class LihatPenerimaPolicy
{
    public function view(User $user): bool
    {
        return $user->status == 'dm';
    }
}
