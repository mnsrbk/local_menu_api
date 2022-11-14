<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Ingredient;
use Illuminate\Http\Request;

class IngredientController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('q')) {
            $q = $request->get('q');
            $ingredients = Ingredient::where('name', 'like', '%' . $q . '%')->orWhere('name', 'like', '%' . ucwords($q) . '%')->paginate(15);
            $ingredients->appends(['q' => $q]);
        } else {
            $ingredients = Ingredient::paginate(15);
        }

        return view('ingredients.index', compact('ingredients'));
    }

    public function create()
    {
        return view('ingredients.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name.*' => 'required',
            'unit.*' => 'required'
        ]);

        Ingredient::create($data);

        return redirect()->route('ingredients.index')->with('success', 'Ingredient goşuldy');
    }

    public function edit(Ingredient $ingredient)
    {
        return view('ingredients.edit', compact('ingredient'));
    }

    public function update(Ingredient $ingredient, Request $request)
    {
        $data = $request->validate([
            'name.*' => 'required',
            'unit.*' => 'required'
        ]);

        $ingredient->update($data);

        return redirect()->route('ingredients.index')->with('success', 'Ingredient üýtgedildi');
    }

    public function destroy(Ingredient $ingredient)
    {
        if ($ingredient->foods()->count()) {
            return redirect()->route('ingredients.index')->with('warning', 'Bu ingredientde nahar bar');
        }

        $ingredient->delete();

        return redirect()->route('ingredients.index')->with('danger', 'Ingredient pozuldy');
    }
}
