<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\FoodSizeRequest;
use App\Models\Food;
use App\Models\FoodSize;
use Illuminate\Http\Request;

class FoodSizeController extends Controller
{
    public function create(Food $food)
    {
        return view('foods.size.create', compact('food'));
    }

    public function store(Food $food, FoodSizeRequest $request)
    {
        $request->merge(['food_id' => $food->id]);

        FoodSize::create($request->only('name', 'price', 'food_id'));

        return redirect()->route('foods.show', $food->id)->with('success', trans('main.food_price_added'));
    }

    public function edit(FoodSize $size)
    {
        return view('foods.size.edit', compact('size'));
    }

    public function update(FoodSize $size, FoodSizeRequest $request)
    {
        $size->update($request->only('name', 'price'));

        return redirect()->route('foods.show', $size->food->id)->with('success', trans('main.food_price_updated'));
    }

    public function destroy(FoodSize $size)
    {
        $size->delete();

        return redirect()->route('foods.show', $size->food->id)->with('success', trans('main.food_price_deleted'));
    }
}
