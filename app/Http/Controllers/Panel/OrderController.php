<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Hall;
use App\Models\Order;
use App\Models\Table;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $append = [];
        $halls = Hall::all();
        $date = $request->get('date-range');
        $stat = $request->get('statuses');
        $bill = [];
        $paid = [];
        if (!empty($stat)) {
            foreach ($stat as $req) {
                if ($req == 'bill-taken') {
                    array_push($bill, '1');
                } elseif ($req == 'bill-not-taken') {
                    array_push($bill, '0');
                }
            }    
        }
        if (!empty($stat)) {
            foreach ($stat as $req) {
                if ($req == 'paid') {
                    array_push($paid, '1');
                } elseif ($req == 'not-paid') {
                    array_push($paid, '0');
                }
            }    
        }

        $orders = Order::where(function ($query) use ($request) {
            if ($request->has('q')) {
                $query->where('code', 'like', '%' . $request->get('q') . '%')->orWhere('code', 'like', '%' . ucwords($request->get('q')) . '%');
            }
        })->whereHas('table', function ($query) use ($request) {
            if ($request->has('halls')) {
                $query->whereIn('hall_id', $request->get('halls'));
            }
        })->where(function ($query) use ($date) {
            if (!empty($date)) {
                if (strlen($date) == 23) {
                    $from = date('Y-m-d', strtotime(substr($date, 0, 10)));
                    $to = date('Y-m-d', strtotime(substr($date, 13, 23)));
                    $query->whereBetween('created_at', [$from, $to]);
                } else {
                    $query->whereDate('created_at', date('Y-m-d', strtotime($date)));
                }
            }
        })->where(function ($query) use ($paid) {
            if (!empty($paid)) {
                $query->whereIn('is_paid', $paid);
            }
        })->where(function ($query) use ($bill) {
            if (!empty($bill)) {
                $query->whereIn('bill_taken', $bill);
            }
        })->orderBy('is_paid')->paginate(15);

        if ($request->has('q')) {
            $append['q'] = $request->get('q');
        }

        if (count($append)) {
            $orders->appends($append);
        }

        return view('orders.index', compact('orders','halls', 'bill', 'paid'));
    }

    public function show(Order $order)
    {
        return view('orders.show', compact('order'));
    }

    public function update(Order $order, Request $request)
    {
        $request->validate([
            'bill_taken' => 'required_without_all:is_paid',
            'is_paid' => 'required_without_all:bill_taken',
        ]);

        if ($request->has('bill_taken')) {
            $order->update(['bill_taken' => 1]);

            return back()->with('success', trans('main.bill_taken'));
        }

        if ($request->has('is_paid')) {
            $order->update([
                'bill_taken' => 1,
                'is_paid' => 1
            ]);

            Table::whereId($order->table_id)->update(['status' => 'empty']);

            return back()->with('success', trans('main.payment_accepted'));
        }
    }
}
