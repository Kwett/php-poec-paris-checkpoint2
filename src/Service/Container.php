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

        if ($numberCake <= self::SMALL) {
            $numberS++;
        } elseif ($numberCake <= self::MEDIUM) {
            $numberM++;
        } elseif ($numberCake <= self::LARGE) {
            $numberL++;
        } else {
            $numberL += intdiv($numberCake, self::LARGE);
            $remainder = $numberCake % self::LARGE;
            if ($remainder !== 0) {
                if ($remainder <= self::SMALL) {
                    $numberS++;
                } elseif ($remainder <= self::MEDIUM) {
                    $numberM++;
                } elseif ($remainder <= self::LARGE) {
                    $numberL++;
                }
            }
        }

        return [(int) $numberL, (int) $numberM, (int) $numberS];
    }
}
