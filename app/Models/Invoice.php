<?php
// Developer: Ali Abu Taleb | Reviewed: 2025-10-18

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{

    use HasFactory;
    protected $fillable = ['order_id', 'file_path', 'generated_at'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

  
    public function getFilePathAttribute($value)
    {
        return storage_path('app/invoices/' . $value);
    }
}
