<?php

namespace App\Domain\BusinessTrip\Service\Allowance\AllowanceCalculator;

use App\Domain\BusinessTrip\Service\Allowance\AllowanceModifier\AllowanceModifierInterface;
use App\Domain\BusinessTrip\Service\Allowance\AllowanceModifier\MultiplierAllowanceModifier;

class PlAllowanceCalculator extends AbstractAllowanceCalculator
{
    public function getBaseAmount(): float
    {
        return 10;
    }

    public function getModifierChain(): AllowanceModifierInterface
    {
        return new MultiplierAllowanceModifier(3, 2);
    }
}