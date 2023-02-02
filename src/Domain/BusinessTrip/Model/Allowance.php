<?php

namespace App\Domain\BusinessTrip\Model;

class Allowance
{
    public function __construct(
        public int $dayOfBusinessTrip,
        public float $amount
    ) {
    }
}