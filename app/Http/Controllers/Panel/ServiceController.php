<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function create()
    {
        if (!Service::count()) {
            return view('services.create');
        }

        return redirect()->route('restaurant')->with('warning', trans('main.service_cost_already_exists'));
    }

    public function store(Request $request)
    {
        if (!Service::count()) {
            $request->validate([
                'cost' => 'required',
                'unit' => 'required|in:percent,manat'
            ]);

            if ($request->get('unit')  == 'manat') {
                $request->merge(['cost' => $request->get('cost') * 100]);
            }

            $request->merge(['name' => 'service_cost']);

            Service::create($request->all());

            return redirect()->route('restaurant')->with('success', trans('main.service_cost_created'));
        }

        return redirect()->route('restaurant')->with('warning', trans('main.service_cost_already_exists'));
    }

    public function edit(Service $service)
    {
        return view('services.edit', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        $request->validate([
            'cost' => 'required',
            'unit' => 'required'
        ]);

        if ($request->get('unit')  == 'manat') {
            $request->merge(['cost' => $request->get('cost') * 100]);
        }

        $service->update($request->all());

        return redirect()->route('restaurant')->with('success', trans('main.service_cost_updated'));
    }
}
