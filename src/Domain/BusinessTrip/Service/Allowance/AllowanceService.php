<?php

namespace App\Domain\BusinessTrip\Service\Allowance;

use App\Domain\BusinessTrip\Entity\BusinessTrip;
use App\Domain\BusinessTrip\Enums\Country;
use App\Domain\BusinessTrip\Service\Allowance\AllowanceCalculator\AllowanceCalculatorInterface;
use App\Domain\BusinessTrip\Service\Allowance\AllowanceCalculator\DeAllowanceCalculator;
use App\Domain\BusinessTrip\Service\Allowance\AllowanceCalculator\EsAllowanceCalculator;
use App\Domain\BusinessTrip\Service\Allowance\AllowanceCalculator\GbAllowanceCalculator;
use App\Domain\BusinessTrip\Service\Allowance\AllowanceCalculator\PlAllowanceCalculator;
use App\Domain\BusinessTrip\Service\BusinessTripPeriodGenerator;

class AllowanceService
{
    private AllowanceCalculatorInterface $strategy;

    public function __construct(
        private readonly BusinessTripPeriodGenerator $businessTripPeriodGenerator
    ) {
    }

    public function applyAllowance(BusinessTrip $businessTrip): BusinessTrip
    {
        $this->setStrategy($businessTrip->country);
        $businessTrip->allowance = $this->strategy->calculateAllowance(
            $this->businessTripPeriodGenerator->getBusinessTripPeriod($businessTrip)
        );

        return $businessTrip;
    }

    private function setStrategy(Country $country): void
    {
        $strategy = match ($country) {
            Country::PL => PlAllowanceCalculator::class,
            Country::DE => DeAllowanceCalculator::class,
            Country::GB => GbAllowanceCalculator::class,
            Country::ES => EsAllowanceCalculator::class,
        };
        $this->strategy = new $strategy($this->businessTripPeriodGenerator);
    }
}