<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'item_id',
        'size_id',
        'quantity',
        'discount',
        'cost',
        'total_cost'
    ];

    public function food()
    {
        return $this->belongsTo(Food::class, 'item_id');
    }

    public function size()
    {
        return $this->belongsTo(FoodSize::class, 'size_id');
    }
}
