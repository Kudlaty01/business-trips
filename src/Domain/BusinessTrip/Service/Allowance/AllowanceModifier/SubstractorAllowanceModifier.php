<?php

namespace App\Domain\BusinessTrip\Service\Allowance\AllowanceModifier;

use App\Domain\BusinessTrip\Model\Allowance;

class SubstractorAllowanceModifier extends AbstractAllowanceModifier
{
    public function __construct(
        int $modifierStartDay,
        private readonly float $substractedAmount
    ) {
        parent::__construct($modifierStartDay);
    }

    protected function performModification(Allowance $allowance): float
    {
        return $allowance->amount - $this->substractedAmount;
    }
}