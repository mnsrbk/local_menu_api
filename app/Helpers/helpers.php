<?php

if (!function_exists('price_format')) {
    function price_format($number)
    {
        if ($number % 100 != 0) {
            $number /= 100;
            return number_format($number, 2, '.', '');
        }

        return number_format($number / 100, 2, '.', '');
    }
}
//
//if (!function_exists('phone_format')) {
//    function phone_format($phone, $withDialCode = false)
//    {
//        $split = str_split($phone, 2);
//
//        if ($withDialCode) {
//            return '+993-' . implode('-', $split);
//        }
//
//        return implode('-', $split);
//    }
//}
//
//if (!function_exists('total_price_and_quantity')) {
//    function total_price_and_quantity($basket)
//    {
//        $sum = 0;
//        $quantity = 0;
//
//        foreach ($basket as $item) {
//            $sum += ($item->getPrice() * $item->quantity);
//            $quantity += $item->quantity;
//        }
//
//        return [$sum, $quantity];
//    }
//}