<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Models\Food;
use App\Models\FoodSize;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Service;
use App\Models\Table;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class OrderController extends BaseController
{
    public function index(Table $table)
    {
        if ($table->status == 'not_empty') {
//            $orders = Order::whereTableId($table->id)->whereBillTaken(false)->get();
            return OrderResource::collection(Order::whereTableId($table->id)->whereIsPaid(false)->get());
        }

        return $this->respondInvalid('Table status is empty');
    }

    public function store(Request $request)
    {
        $request->validate([
            'items' => 'required',
            'table_id' => 'required|exists:tables,id',
        ]);

        $cost = 0;
        $items = $request->get('items');
        $service = Service::whereName('service_cost')->firstOrFail();
        $table = Table::whereId($request->get('table_id'))->first();

        if ($table->status == 'not_empty') {
            $order = Order::whereTableId($table->id)->firstOrFail();

            if (!$order->bill_taken) {
                foreach ($items as $item) {
                    $size = FoodSize::whereId($item['size_id'])->firstOrFail();

                    $price_arr = $this->getPriceById($size, false);
                    $order_item = OrderItem::whereOrderId($order->id)->whereItemId($size->food->id)->whereSizeId($size->id)->first();

                    // if order_item exists then increases quantity
                    if ($order_item) {
                        $order_item->quantity += $item['quantity'];
                        $order_item->save();
                    } else {
                        $order_item = [
                            'order_id' => $order->id,
                            'item_id' => $size->food->id,
                            'size_id' => $size->id,
                            'quantity' => $item['quantity'],
                            'cost' => $price_arr['price'],
                            'discount' => $price_arr['discount_price'],
                            'total_cost' => $price_arr['price'] - $price_arr['discount_price']
                        ];

                        OrderItem::create($order_item);
                    }

                    $cost += $this->getPriceById($size) * $item['quantity'];
                }

                $cost = $order->cost + $cost;
                $service_cost = $this->getServiceCost($service, $cost);

                $order->update([
                    'cost' => $cost,
                    'service_cost' => $service_cost,
                    'total_cost' => $cost + $service_cost,
                ]);

                return $this->respondCreated('Added items to active order');
            }
        }

        foreach ($items as $item) {
            $size = FoodSize::whereId($item['size_id'])->firstOrFail();
            $cost += $this->getPriceById($size) * $item['quantity'];
        }

        $service_cost = $this->getServiceCost($service, $cost);

        $request->merge([
            'code' => strtoupper(Str::random(8)),
            'cost' => $cost,
            'service_cost' => $service_cost,
            'total_cost' => $cost + $service_cost,
        ]);

        $order = Order::create($request->all());

        //create orderItems
        foreach ($items as $item) {
            $size = FoodSize::whereId($item['size_id'])->firstOrFail();
            $price_arr = $this->getPriceById($size, false);

            $order_item = [
                'order_id' => $order->id,
                'item_id' => $size->food->id,
                'size_id' => $size->id,
                'quantity' => $item['quantity'],
                'cost' => $price_arr['price'],
                'discount' => $price_arr['discount_price'],
                'total_cost' => $price_arr['price'] - $price_arr['discount_price']
            ];

            OrderItem::create($order_item);
        }

        //change table status
        $table->update(['status' => 'not_empty']);

        return $this->respondCreated('Order successfully created');
    }

    private function getPriceById($size, $single_price = true)
    {
        if ($single_price) {
            return $size->getDiscountPrice();
        }

        $discount = 0;

        if ($size->food->discount) {
            $discount = $size->price - $size->getDiscountPrice();
        }

        return [
            'price' => $size->price,
            'discount_price' => $discount
        ];
    }

    private function getServiceCost($collection, $cost)
    {
        $service_cost = 0;

        if ($collection->unit == 'manat' && $collection->cost > 0) {
            $service_cost = $collection->cost;
        }

        if ($collection->unit == 'percent' && $collection->cost > 0) {
            $service_cost = ($cost * $collection->cost) / 100;
        }

        return $service_cost;
    }
}
