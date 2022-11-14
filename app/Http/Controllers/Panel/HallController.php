<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\HallRequest;
use App\Models\Hall;
use Illuminate\Http\Request;

class HallController extends Controller
{
    public function index(Request $request)
    {
        if($request->has('q')){
                $q = $request->get('q');
                $halls = Hall::where('name', 'like', '%' . $q . '%')
                ->orWhere('name', 'like', '%' . ucwords($q) . '%')->paginate(10);
                $halls->append(['q' => $q]);
            } else {
            $halls = Hall::paginate(10);
        }

        return view('halls.index', compact('halls'));
    }

    public function create()
    {
        return view('halls.create');
    }

    public function store(HallRequest $request)
    {
        Hall::create($request->only('name'));

        return redirect()->route('halls.index')->with('success', trans('main.hall_created'));
    }

    public function edit(Hall $hall)
    {
        return view('halls.edit', compact('hall'));
    }

    public function show(Hall $hall)
    {
        $tables = $hall->tables()->paginate(15);

        return view('halls.show', compact('hall', 'tables'));
    }

    public function update(HallRequest $request, Hall $hall)
    {
        $hall->update($request->only('name'));

        return redirect()->route('halls.index')->with('success', trans('main.hall_updated'));
    }

    public function destroy(Hall $hall)
    {
        if ($hall->tables()->exists()) {
            return back()->with('warning', trans('main.hall_has_tables'));
        }

        $hall->delete();

        return redirect()->route('halls.index')->with('danger', trans('main.hall_deleted'));

    }

    public function toggle(Hall $hall)
    {
        $hall->is_active = !$hall->is_active;
        $hall->save();

        return redirect()->route('halls.show', $hall->id)->with('warning', trans('main.hall_changed_status'));
    }
}
