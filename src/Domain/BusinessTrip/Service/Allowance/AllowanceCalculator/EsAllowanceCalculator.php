<?php

namespace App\Domain\BusinessTrip\Service\Allowance\AllowanceCalculator;

use App\Domain\BusinessTrip\Service\Allowance\AllowanceModifier\AllowanceModifierInterface;
use App\Domain\BusinessTrip\Service\Allowance\AllowanceModifier\SubstractorAllowanceModifier;

class EsAllowanceCalculator extends AbstractAllowanceCalculator
{
    public function getBaseAmount(): float
    {
        return 150;
    }

    public function getModifierChain(): AllowanceModifierInterface
    {
        return (new SubstractorAllowanceModifier(3, 50))
            ->setNext(
                new SubstractorAllowanceModifier(5, 25)
            );
    }
}