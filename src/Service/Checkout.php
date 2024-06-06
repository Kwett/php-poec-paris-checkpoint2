<?php

namespace App\Service;

class Checkout
{
    /**
     * @param array $cart
     * multidimensional array of associative array
     * containing the indexes ['numberCupcake'] and ['unitPrice']
     * @return array
     * containing the total price at the first index,
     * and the total price minus the discount applied (50-cent) for every three cupcakes purchased at the second index
     * ⬇️ create the calculate() method here ⬇️
     */

    public function calculate(array $cart): array
    {
        $totalPrice = 0;
        $totalCupcakes = 0;
        foreach ($cart as $order) {
            $totalPrice += $order['numberCupcake'] * $order['unitPrice'];
            $totalCupcakes += $order['numberCupcake'];
        }
        $discountCounter = floor($totalCupcakes / 3);
        $finalPrice = $totalPrice - ($discountCounter * 0.5);

        return [$totalPrice, $finalPrice];
    }
}
