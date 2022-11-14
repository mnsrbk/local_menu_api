<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class FoodSize extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = ['name', 'food_id', 'price'];
    public $translatable = ['name'];
    public $timestamps = false;

    public function setPriceAttribute($value)
    {
        $this->attributes['price'] = $value * 100;
    }

    public function food()
    {
        return $this->belongsTo(Food::class);
    }

    public function getDiscountPrice()
    {
        $discount = $this->food->discount;

        if ($discount) {
            if ($this->food->discount_unit == 'percent') {
                return $this->price - (($discount * $this->price) / 100);
            }

            return $this->price - ($discount * 100);
        }

        return $this->price;
    }
}
