<?php
// Developer: Ali Abu Taleb | Reviewed: 2025-10-17
namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    public function view(User $authUser, User $targetUser): bool
    {
        if ($authUser->role === 'admin')
            return true;
        return $authUser->id === $targetUser->id; // Users can only view themselves
    }
}
