<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\HallResource;
use App\Models\Hall;
use Illuminate\Http\Request;

class TableController extends BaseController
{
    public function index()
    {
        $halls = Hall::whereIsActive(true)->get();

        return HallResource::collection($halls);
    }
}
