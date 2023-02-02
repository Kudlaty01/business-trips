<?php

namespace App\Domain\BusinessTrip\Service\Allowance\AllowanceModifier;

use App\Domain\BusinessTrip\Model\Allowance;

class MultiplierAllowanceModifier extends AbstractAllowanceModifier
{
    public function __construct(
        int $modifierStartDay,
        private readonly float $multiplier
    ) {
        parent::__construct($modifierStartDay);
    }

    protected function performModification(Allowance $allowance): float
    {
        return $allowance->amount * $this->multiplier;
    }
}