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
    public const DISCOUNT = 0.5;
    public const DISCOUNT_NUMBER = 3;
    public function calculate(array $cart): array
    {
        $totalPrice = 0.0;
        $discountedPrice = 0.0;
        $totalItems = 0;

        foreach ($cart as $item) {
            $numberCupcakes = $item['numberCupcake'];
            $unitPrice = $item['unitPrice'];
            $itemTotal = $numberCupcakes * $unitPrice;
            $totalPrice += $itemTotal;
            $totalItems += $item['numberCupcake'];
        }
        $discountNumber = floor($totalItems / self::DISCOUNT_NUMBER);
        $discountedPrice = $totalPrice - ($discountNumber * self::DISCOUNT);


        return [$totalPrice, $discountedPrice];
    }
}
