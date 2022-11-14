<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Hall extends Model
{
    use HasFactory, HasTranslations;
    protected $fillable = ['name', 'is_active'];
    public $translatable = ['name'];

   public function tables()
   {
       return $this->hasMany(Table::class);
   }
}
