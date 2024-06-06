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

    //  public function calculate(array $cart)
    //  {
    //     if (2 < count($cart)) {
    //         $i=0;
    //         while ($i < count($cart))
    //         {
    //             $reductionPrice = 0;
    //             foreach ($cart as $key=> $articles) {
    //                 $result = $articles['numberCupcake'] * $articles['unitPrice'];
    //                 if (($key + 1) % 3 === 0)  {
    //                     $result *= 0.5;
    //                 }
    //                 $reductionPrice += $result;
    //                 $i++;
    //             }
    //             $prices[] = $reductionPrice;
    //         }
    //     } else {
    //         $prices[] = $totalPrice;
    //     }
    //     var_dump($prices) ;
    //  }

    public function calculate(array $cart)
    {
        $prices = [];
        $i=0;
        while ($i < count($cart))
        {
            $totalPrice = 0;
            foreach ($cart as $articles) {
                $result = $articles['numberCupcake'] * $articles['unitPrice'];
                $totalPrice += $result;
                $i++;
            }
            $prices[] = $totalPrice;
        }
        $numberCupcakes = 0;
        foreach ($cart as $articles) {
            $numberCupcakes += $articles['numberCupcake'];
        }
        var_dump($numberCupcakes);
        var_dump($prices);
    }
}
