<?php
// Developer: Ali Abu Taleb | Reviewed: 2025-10-18

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    
    use HasFactory;
    protected $fillable = ['order_id', 'product_id', 'seller_id', 'quantity', 'price'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

   
    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }
}
