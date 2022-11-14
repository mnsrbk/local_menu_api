<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Food;
use App\Models\FoodSize;
use Illuminate\Http\Request;

class WebController extends Controller
{
    // public function format($i) {
    //     $result = explode(' ', $i);
    //     $result = end($result);
    //     $result = explode(':', $result);
    //     $result = $result[0] * 60 + $result[1];
    //     return ($result);
    // }

    public function index(){

        // $prices = [
        //     '2022-01-02 00:00' => '5', 
        //     '2022-01-02 10:00' => '6', 
        //     '2022-01-02 12:00' => '100000',
        //     '2022-01-02 12:01' => '6', 
        //     '2022-01-02 20:00' => '5',
        //     '2022-01-02 21:00' => '6', 
        // ];
        // $price = 0;
        // $keys = array_keys($prices);
        // $vals = array_values($prices);
        // $times = [];



        // for ($i=0; $i < count($keys); $i++) {
        //     if ($i + 1 < count($keys)) {
        //         $end = $this->format($keys[$i+1]);
        //         $start = $this->format($keys[$i]);
        //         array_push($times, $end-$start);
        //     } else {
        //         $res = 1440-array_sum($times);
        //         array_push($times, $res);
        //     }
        // }

        // $total = array_map(function($x, $y) { return $x * $y; },
        //            $times, $vals);
        // $price = array_sum($total)/1440;

        // return ($price);

        $categories = Category::whereParentId(null)->orderBy('order')->get();
        return view('web.home', compact('categories'));
    }
    public function category(Category $category){
        $menu = Category::whereParentId(null)->orderBy('order')->get();
        if ($category->is_leaf){
            $foods = Food::whereCategoryId($category->id)->get();
            return view('web.category', compact('foods', 'menu', 'category'));
        }else{
            $categories = Category::whereParentId($category->id)->orderBy('order')->get();
            return view('web.subcategory', compact('categories', 'menu', 'category'));
        }
    }
    public function food(Category $category, Food $food){
        $menu = Category::whereParentId(null)->get();
        // $categories = Category::whereParentId(null)->get();
        return view('web.food', compact('food', 'menu', 'category'));
    }
}
