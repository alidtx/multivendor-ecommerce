<?php
// Developer: Ali Abu Taleb | Reviewed: 2025-10-18

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{  
    use HasFactory;
    protected $fillable = ['buyer_id', 'order_number', 'total_amount', 'status'];


    public function buyer()
    {
        return $this->belongsTo(User::class, 'buyer_id');
    }

  
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

  
    public function invoice()
    {
        return $this->hasOne(Invoice::class);
    }
}
