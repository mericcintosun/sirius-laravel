<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'order_number',
        'status',
        'total_amount',
        'delivery_address',
        'notes',
    ];

    protected $casts = [
        'total_amount' => 'decimal:2',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public static function generateOrderNumber()
    {
        $year = date('Y');
        $lastOrder = self::whereYear('created_at', $year)
                        ->orderBy('id', 'desc')
                        ->first();
        
        $number = $lastOrder ? (int) substr($lastOrder->order_number, -3) + 1 : 1;
        
        return 'ORD-' . $year . '-' . str_pad($number, 3, '0', STR_PAD_LEFT);
    }
    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }
}
