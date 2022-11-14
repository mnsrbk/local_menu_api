<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Password;
use App\Models\Service;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    public function index()
    {
        $service = Service::whereName('service_cost')->first();

        $passwords = collect();
        $current = Password::latest()->first();

        if (!empty($current)) {
            $passwords = Password::whereNotIn('id', [$current->id])->get();
        }

        return view('restaurant', compact('current', 'passwords', 'service'));
    }
}
