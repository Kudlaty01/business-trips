<?php

namespace App\Domain\BusinessTrip\Service\Allowance\AllowanceCalculator;

use App\Domain\BusinessTrip\Model\Allowance;
use DatePeriod;
use DateTimeInterface;

abstract class AbstractAllowanceCalculator implements AllowanceCalculatorInterface
{
    public function calculateAllowance(DatePeriod $businessTripPeriod): float
    {
        $allowance = 0;
        foreach ($businessTripPeriod as $dayIndex => $businessTripDate) {
            $allowance += $this->getAllowanceForDay(
                $businessTripDate,
                $dayIndex + 1
            );
        }

        return $allowance;
    }

    protected function getAllowanceForDay(
        DateTimeInterface $date,
        int $dayIndex
    ): float {
        return $this->isWorkDay($date)
            ? $this->getModifierChain()->modifyAllowance(new Allowance(
                $dayIndex,
                $this->getBaseAmount()
            ))
            : 0;
    }

    private function isWorkDay(DateTimeInterface $date): bool
    {
        return (int) $date->format('N') <= 5;
    }
}