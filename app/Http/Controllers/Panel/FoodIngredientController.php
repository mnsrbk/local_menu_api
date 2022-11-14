<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\FoodIngredientRequest;
use App\Models\Food;
use App\Models\FoodIngredient;
use App\Models\Ingredient;
use Illuminate\Http\Request;

class FoodIngredientController extends Controller
{
    public function create(Food $food)
    {
        $food_ingredients = FoodIngredient::whereFoodId($food->id)->get();
        $ingredients = Ingredient::all();
        return view('foods.ingredient.create', compact('food','ingredients', 'food_ingredients'));
    }

    public function store(Food $food, FoodIngredientRequest $request)
    {
        $request->merge(['food_id' => $food->id]);
        for($i=0; $i<count($request->ingredient_id); $i++){
            FoodIngredient::create([
                'food_id' => $request->food_id,
                'ingredient_id' => $request->ingredient_id[$i],
                'value' => $request->value[$i]
            ]);
        }

        return redirect()->route('foods.ingredients.create', $food->id)->with('success', trans('main.food_ingredient_added'));
    }

    public function destroy(FoodIngredient $ingredient)
    {
        $ingredient->delete();

        return redirect()->route('foods.ingredients.create', $ingredient->food->id)->with('success', trans('main.food_price_deleted'));
    }
}
