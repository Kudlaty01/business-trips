<?php

namespace App\Domain\BusinessTrip\Service\Allowance\AllowanceCalculator;

use App\Domain\BusinessTrip\Service\Allowance\AllowanceModifier\AllowanceModifierInterface;
use App\Domain\BusinessTrip\Service\Allowance\AllowanceModifier\MultiplierAllowanceModifier;

class DeAllowanceCalculator extends AbstractAllowanceCalculator
{
    public function getBaseAmount(): float
    {
        return 50;
    }

    public function getModifierChain(): AllowanceModifierInterface
    {
        return new MultiplierAllowanceModifier(2, 1.75);
    }
}