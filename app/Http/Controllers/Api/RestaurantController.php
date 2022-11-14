<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Password;
use App\Models\Service;
use Illuminate\Http\Request;

class RestaurantController extends BaseController
{
    public function index()
    {
        $current = Password::latest()->first();
        $service = Service::whereName('service_cost')->first();

        if (!empty($current) && !empty($service)) {
            return $this->respondOK([
                'code' => $current->code,
                'service' => [
                    'cost' => $service->cost,
                    'unit' => $service->unit
                ]
            ]);
        }

        return $this->respondNotFound('Could not found the password or service');
    }
}
