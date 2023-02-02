<?php

namespace App\Domain\BusinessTrip\Service;

use App\Domain\BusinessTrip\Entity\BusinessTrip;
use DateInterval;
use DatePeriod;
use DateTimeInterface;

class BusinessTripPeriodGenerator
{
    /**
     * @param BusinessTrip $businessTrip
     *
     * @return DatePeriod
     */
    public function getBusinessTripPeriod(BusinessTrip $businessTrip
    ): DatePeriod {
        return new DatePeriod(
            $businessTrip->startDate,
            new DateInterval('P1D'),
            $businessTrip->endDate,
            $this->resolveDatePeriodOptions(
                $businessTrip->startDate,
                $businessTrip->endDate
            )
        );
    }

    private function resolveDatePeriodOptions(
        DateTimeInterface $startDate,
        DateTimeInterface $endDate
    ): int {
        return $this->getDatePeriodOptionForPastHour(
                $startDate,
                16,
                DatePeriod::EXCLUDE_START_DATE
            )
            | $this->getDatePeriodOptionForPastHour(
                $endDate,
                8,
                DatePeriod::INCLUDE_END_DATE
            );
    }

    private function getDatePeriodOptionForPastHour(
        DateTimeInterface $date,
        int $hour,
        int $dateTimePeriodOption
    ): int {
        return $this->isTimePastHour($date, $hour)
            ? $dateTimePeriodOption
            : 0;
    }

    private function isTimePastHour(DateTimeInterface $date, int $hour): bool
    {
        return ((int) $date->format('H')) >= $hour;
    }
}