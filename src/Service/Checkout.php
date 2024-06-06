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
        $bill = [];
        $totalPrice = 0;

        foreach($cart as $cupcake) {
            $totalPrice += $cupcake['numberCupcake'] * $cupcake['unitPrice'];
        }

        $bill[] = $totalPrice;

        return $bill;
    }
}
