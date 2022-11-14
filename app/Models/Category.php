<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Category extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = ['name', 'image', 'parent_id', 'is_drink', 'is_leaf'];
    public $translatable = ['name'];

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id', 'id');
    }

    public function foods()
    {
        return $this->hasMany(Food::class);
    }

    public function activeFoods()
    {
        return $this->foods()->whereIsActive(true)->get();
    }

    public function getImage()
    {
        return asset('uploads/categories/' . $this->image);
    }
    
    public function getThumb()
    {
        return asset('uploads/categories/thumbs/' . $this->image);
    }

    public function hasParent()
    {
        return $this->parent()->exists();
    }

    public function hasChildren()
    {
        return $this->children()->exists();
    }

    public function foodsCount()
    {
        if ($this->hasChildren()) {
            $sum = 0;

            foreach ($this->children as $child) {
                $sum += $child->foods()->count();
            }

            return $sum;
        }

        return $this->foods()->count();
    }
}
