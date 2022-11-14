<?php

namespace App\Http\Controllers\Panel;

use App\Helpers\CollectionHelper;
use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        if($request->has('q')){
            $q = $request->get('q');
            $categories = Category::where('name', 'like', '%' . $q . '%')
            ->orWhere('name', 'like', '%' . ucwords($q) . '%')->paginate(10);
            $categories->append(['q' => $q]);
        } else {
            $categories = Category::paginate(10);
        }

        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        $parents = Category::whereNull('parent_id')->whereIsLeaf(false)->get();

        return view('categories.create', compact('parents'));
    }

    public function store(CategoryRequest $request)
    {
        $request->merge($this->toMergeRequests($request));

        Category::create($request->all());

        return redirect()->route('categories.index')->with('success', trans('main.category_created'));
    }

    public function show(Category $category)
    {
        if ($category->hasChildren()) {
            $foods = collect();
            foreach ($category->children as $child) {
                $foods = $foods->merge($child->foods);
            }

            $foods = CollectionHelper::paginate($foods, 1);
        } else {
            $foods = $category->foods()->paginate(1);
        }

        return view('categories.show', compact('category', 'foods'));
    }

    public function edit(Category $category)
    {
        $parents = Category::whereNull('parent_id')->whereIsLeaf(false)->get();

        return view('categories.edit', compact('category', 'parents'));
    }

    public function update(Category $category, CategoryRequest $request)
    {
        $request->merge($this->toMergeRequests($request, $category));

        $category->update($request->all());

        return redirect()->route('categories.show', $category->id)->with('success', trans('main.category_updated'));
    }

    public function destroy(Category $category)
    {
        if ($category->hasChildren()) {
            return redirect()->route('categories.index')->with('warning', trans('main.category_has_subcategories'));
        }

        if ($category->foods()->exists()) {
            return redirect()->route('categories.index')->with('warning', trans('main.category_has_foods'));

        }

        $this->removeFile($category->image, 'categories');
        $category->delete();

        return redirect()->route('categories.index')->with('danger', trans('main.category_deleted'));
    }

     public function order()
    {
        $categories = Category::whereNull('parent_id')->orderBy('order')->get();

        if (count($categories) > 1) {
            return view('categories.order', compact('categories'));
        }

        return redirect()->route('categories.index')->with('warning', trans('main.at_least_must_have_two_categories'));
    }

    public function orderUpdate(Request $request)
    {

        foreach ($request->get('order', []) as $key => $order) {
            Category::whereId($order)->update(['order' => $key + 1]);
        }

        return redirect()->route('categories.index')->with('success', trans('main.category_ordered'));
    }

    private function toMergeRequests($req, $category = null)
    {
        $data = [];

        // if has parent then must be leaf
        if ($req->has('parent_id') || $req->has('is_leaf')) {
            $data['is_leaf'] = true;
        }

        if (!$req->has('parent_id') && !$req->has('is_leaf')) {
            $data['is_leaf'] = false;
        }

        if ($req->has('is_drink')) {
            $data['is_drink'] = true;
        } else {
            $data['is_drink'] = false;
        }

        if ($category) {
            if ($category->parent_id && !$req->has('parent_id')) {
                $data['parent_id'] = null;
            }
        }

        if ($req->has('file')) {
            if ($category) {
                $this->removeFile($category->image, 'categories');
            }

            $req->merge(['image' => $this->uploadFile($req->file('file'), 'categories')]);
        }

        return $data;
    }

}
