<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Food extends Model
{
    use HasFactory, HasTranslations;

    protected $table = 'foods';
    protected $fillable = ['name', 'description', 'image', 'category_id', 'discount', 'discount_unit', 'is_active'];
    public $translatable = ['name', 'description'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function sizes()
    {
        return $this->hasMany(FoodSize::class);
    }

    public function ingredients()
    {
        return $this->hasMany(FoodIngredient::class);
    }

    public function orders()
    {
        return $this->hasMany(OrderItem::class, 'item_id');
    }

    public function getImage()
    {
        return asset('uploads/foods/' . $this->image);
    }
    
    public function getThumb()
    {
        return asset('uploads/foods/thumbs/' . $this->image);
    }
}
