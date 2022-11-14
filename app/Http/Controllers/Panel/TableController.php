<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Hall;
use App\Models\Table;
use App\Http\Requests\TableRequest;
use Facade\Ignition\Tabs\Tab;
use Illuminate\Http\Request;

class TableController extends Controller
{
    public function index(Request $request)
    {
        $append = [];

        $halls = Hall::all();
         $tables = Table::where(function ($query) use ($request) {
            if ($request->has('q')) {
                $query->where('number', 'like', '%' . $request->get('q') . '%')->orWhere('number', 'like', '%' . ucwords($request->get('q')) . '%');
            }
        })->where(function ($query) use ($request) {
            if ($request->has('halls')) {
                $query->whereIn('hall_id', $request->get('halls'));
            }
        })->where(function ($query) use ($request) {
            if ($request->has('statuses')) {
                $query->whereIn('status', $request->get('statuses'));
            }
        })->paginate(10);


        if ($request->has('q')) {
            $append['q'] = $request->get('q');
        }

        if ($request->has('halls')) {
            $append['halls'] = $request->get('halls');
        }

        if ($request->has('statuses')) {
            $append['statuses'] = $request->get('statuses');
        }

        if (count($append)) {
            $tables->appends($append);
        }
        

        return view('tables.index', compact('tables', 'halls'));
    }

    public function create()
    {
        $halls = Hall::all();

        return view('tables.create', compact('halls'));
    }

    public function store(TableRequest $request)
    {
        Table::create($request->only('number', 'hall_id'));

        return redirect()->route('tables.index')->with('success', trans('main.table_created'));
    }

    public function show(Table $table)
    {
        return view('tables.show', compact('table'));
    }

    public function edit(Table $table)
    {
        return view('tables.edit', compact('table'));
    }

    public function update(TableRequest $request, Table $table)
    {
        $table->update($request->only('number'));

        return redirect()->route('tables.index')->with('success', trans('main.table_updated'));
    }

    public function destroy(Table $table)
    {
        // if ($table->reservations()->exists() || $table->orders()->exists()) {
        //     return back()->with('warning', trans('main.table_has_order_or_reserved'));
        // }

        $table->delete();

        return redirect()->route('tables.index')->with('danger', trans('main.table_deleted'));
    }

    public function toggle(Table $table)
    {
        $table->is_active = !$table->is_active;
        $table->save();

        return redirect()->route('tables.show', $table->id)->with('warning', trans('main.table_changed_status'));
    }
}
