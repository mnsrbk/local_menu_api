<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Password;
use Illuminate\Http\Request;

class PasswordController extends Controller
{
    public function create()
    {
        return view('passwords.create');
    }

    public function store(Request $request)
    {
        $request->validate(['code' => 'required|integer|between:10000,99999']);

        Password::create($request->only('code'));

        return redirect()->route('restaurant')->with('success', trans('main.tablet_password_added'));
    }

    public function destroy()
    {
        $current = Password::latest()->first();

        if (!empty($current)) {
            Password::whereNotIn('id', [$current->id])->delete();

            return redirect()->route('restaurant')->with('danger', trans('main.tablet_password_deleted'));
        }

        return redirect()->route('restaurant')->with('warning', trans('main.no_tablet_password_history'));
    }
}
