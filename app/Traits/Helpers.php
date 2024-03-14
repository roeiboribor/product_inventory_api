<?php

namespace App\Traits;

trait Helpers
{
    public function checkPositiveOrNegative(int $number)
    {
        if ($number > 0) {
            return 'positive';
        } elseif ($number < 0) {
            return 'negative';
        } else {
            return 'zero';
        }
    }
}
