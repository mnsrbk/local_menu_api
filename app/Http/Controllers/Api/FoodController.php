<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class FoodController extends BaseController
{
    public function index()
    {
        return CategoryResource::collection(Category::whereNull('parent_id')->orderBy('order')->get());
    }
}
