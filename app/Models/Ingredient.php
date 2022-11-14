<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Ingredient extends Model
{
    use HasFactory;
    use HasTranslations;

    protected $fillable = ['name', 'unit'];
    public $translatable = ['name', 'unit'];

    public $timestamps = false;

    public function foods()
    {
        return $this->hasMany(FoodIngredient::class);
    }
}
