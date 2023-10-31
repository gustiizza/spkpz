<?php

namespace App\Policies;

use App\Models\SubKriteria;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class SubKriteriaPolicy
{

    public function view(User $user): bool
    {
        return $user->status == 'op';
    }
}
