<?php

namespace App\Domain\BusinessTrip\Service\Allowance\AllowanceCalculator;

use App\Domain\BusinessTrip\Service\Allowance\AllowanceModifier\AllowanceModifierInterface;
use App\Domain\BusinessTrip\Service\Allowance\AllowanceModifier\MultiplierAllowanceModifier;

class GbAllowanceCalculator extends AbstractAllowanceCalculator
{
    public function getBaseAmount(): float
    {
        return 75;
    }

    public function getModifierChain(): AllowanceModifierInterface
    {
        return new MultiplierAllowanceModifier(5, 4);
    }
}