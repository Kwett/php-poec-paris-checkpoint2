<?php

namespace Service;

use App\Service\Checkout;
use PHPUnit\Framework\TestCase;

class CheckoutTest extends TestCase
{
    private Checkout $discount;
    protected function setUp(): void
    {
        $this->discount = new Checkout();
    }

    public function testCalculateSimpleOrder()
    {
        $cart = [
            ['numberCupcake' => 3, 'unitPrice' => 2.5],
        ];
        $this->assertEquals([7.5, 7], $this->discount->calculate($cart));
    }

    public function testCalculateMediumOrder()
    {
        $cart = [
            ['numberCupcake' => 3, 'unitPrice' => 2.5],
            ['numberCupcake' => 4, 'unitPrice' => 4.5],
        ];
        $this->assertEquals([25.5, 24.5], $this->discount->calculate($cart));
    }


    public function testCalculateLargeOrder()
    {
        $cart = [
            ['numberCupcake' => 4, 'unitPrice' => 5.5],
            ['numberCupcake' => 3, 'unitPrice' => 2.5],
            ['numberCupcake' => 2, 'unitPrice' => 1.5],
        ];
        $this->assertEquals([32.5, 31], $this->discount->calculate($cart));
    }
}
