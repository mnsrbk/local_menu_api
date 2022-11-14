<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Panel\Auth\LoginController;
use App\Http\Controllers\WebController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::middleware(['localeSessionRedirect', 'localizationRedirect', 'localeViewPath'])->prefix(LaravelLocalization::setLocale())->group(function () {
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login']);

    Route::get('/', [WebController::class, 'index'])->name('home');
    Route::get('category/{category}', [WebController::class, 'category'])->name('category');
    Route::get('category/{category}/{food}', [WebController::class, 'food'])->name('food');

    Route::middleware('auth')->group(function () {
        Route::post('logout', [LoginController::class, 'logout'])->name('logout');
        Route::prefix('panel')->group(function () {
            Route::get('/', [\App\Http\Controllers\Panel\DashboardController::class, 'index'])->name('index');
            Route::get('profile', [\App\Http\Controllers\Panel\DashboardController::class, 'profile'])->name('profile');
            Route::patch('profile', [\App\Http\Controllers\Panel\DashboardController::class, 'profileUpdate'])->name('profile.update');

            Route::get('categories/orders', [\App\Http\Controllers\Panel\CategoryController::class, 'order'])->name('categories.order');
            Route::patch('categories/orders', [\App\Http\Controllers\Panel\CategoryController::class, 'orderUpdate'])->name('categories.order.update');
            Route::resource('categories', \App\Http\Controllers\Panel\CategoryController::class);
            Route::resource('ingredients', \App\Http\Controllers\Panel\IngredientController::class);
            Route::resource('foods', \App\Http\Controllers\Panel\FoodController::class);

            Route::get('foods/{food}/sizes/create', [\App\Http\Controllers\Panel\FoodSizeController::class, 'create'])->name('foods.sizes.create');
            Route::post('foods/{food}/sizes', [\App\Http\Controllers\Panel\FoodSizeController::class, 'store'])->name('foods.sizes.store');
            Route::get('foods/sizes/{size}/edit', [\App\Http\Controllers\Panel\FoodSizeController::class, 'edit'])->name('foods.sizes.edit');
            Route::patch('foods/sizes/{size}', [\App\Http\Controllers\Panel\FoodSizeController::class, 'update'])->name('foods.sizes.update');
            Route::delete('foods/sizes/{size}', [\App\Http\Controllers\Panel\FoodSizeController::class, 'destroy'])->name('foods.sizes.destroy');

            Route::get('foods/{food}/ingredients/create', [\App\Http\Controllers\Panel\FoodIngredientController::class, 'create'])->name('foods.ingredients.create');
            Route::post('foods/{food}/ingredients', [\App\Http\Controllers\Panel\FoodIngredientController::class, 'store'])->name('foods.ingredients.store');
            Route::delete('foods/ingredients/{ingredient}', [\App\Http\Controllers\Panel\FoodIngredientController::class, 'destroy'])->name('foods.ingredients.destroy');

            Route::resource('halls', \App\Http\Controllers\Panel\HallController::class);
            Route::patch('halls/{hall}/toggle', [\App\Http\Controllers\Panel\HallController::class, 'toggle'])->name('halls.toggle');

            Route::resource('tables', \App\Http\Controllers\Panel\TableController::class);
            Route::patch('tables/{table}/toggle', [\App\Http\Controllers\Panel\TableController::class, 'toggle'])->name('tables.toggle');

            Route::get('restaurant', [\App\Http\Controllers\Panel\RestaurantController::class, 'index'])->name('restaurant');

            Route::resource('services', \App\Http\Controllers\Panel\ServiceController::class)->except('index', 'show', 'destroy');

            Route::get('passwords/create', [\App\Http\Controllers\Panel\PasswordController::class, 'create'])->name('passwords.create');
            Route::post('passwords', [\App\Http\Controllers\Panel\PasswordController::class, 'store'])->name('passwords.store');
            Route::delete('passwords', [\App\Http\Controllers\Panel\PasswordController::class, 'destroy'])->name('passwords.destroy');

            Route::get('orders', [\App\Http\Controllers\Panel\OrderController::class, 'index'])->name('orders.index');
            Route::get('orders/{order}', [\App\Http\Controllers\Panel\OrderController::class, 'show'])->name('orders.show');
            Route::patch('orders/{order}', [\App\Http\Controllers\Panel\OrderController::class, 'update'])->name('orders.update');
        });
    });

});

