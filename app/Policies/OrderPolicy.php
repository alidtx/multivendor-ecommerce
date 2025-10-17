<?php
// Developer: Ali Abu Taleb | Reviewed: 2025-10-17

namespace App\Policies;

use App\Models\Order;
use App\Models\User;

class OrderPolicy
{
    
    public function view(User $user, Order $order): bool
    {
       
        if ($user->role === 'admin') {
            return true;
        }

        if ($user->role === 'buyer') {
            return $order->buyer_id === $user->id;
        }


        if ($user->role === 'seller') {
            return $order->items()
                         ->where('seller_id', $user->id)
                         ->exists();
        }

        return false;
    }


}
