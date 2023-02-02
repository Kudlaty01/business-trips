<?php

namespace App\Domain\BusinessTrip\Service\Allowance\AllowanceCalculator;

use App\Domain\BusinessTrip\Service\Allowance\AllowanceModifier\AllowanceModifierInterface;
use DatePeriod;

interface AllowanceCalculatorInterface
{
    public function getBaseAmount(): float;

    public function getModifierChain(): AllowanceModifierInterface;

    public function calculateAllowance(DatePeriod $businessTripPeriod): float;
}