<?php

namespace App\Service;

class Container
{
    public const SMALL = 2;
    public const MEDIUM = 5;
    public const LARGE = 8;

    public function inbox(int $numberCake): array
    {
        $numberL = 0;
        $numberM = 0;
        $numberS = 0;

        $numberL = floor($numberCake / self::LARGE);

        return [$numberL, $numberM, $numberS];
    }
}
