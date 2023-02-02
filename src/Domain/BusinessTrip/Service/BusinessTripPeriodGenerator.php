<?php

namespace App\Domain\BusinessTrip\Service;

use App\Domain\BusinessTrip\Entity\BusinessTrip;
use DateInterval;
use DatePeriod;
use DateTime;
use DateTimeInterface;

use Exception;

readonly class BusinessTripPeriodGenerator
{
    private const DATE_FORMAT_STRING = 'Y-m-d';
    private const TIME_FORMAT_STRING = 'H:i:s';

    public function __construct(private int $minimumHoursForAllowance = 8)
    {
    }

    /**
     * @throws Exception
     */
    public function getBusinessTripPeriod(BusinessTrip $businessTrip
    ): DatePeriod {
        return new DatePeriod(
            $businessTrip->startDate,
            new DateInterval('P1D'),
            $this->getAdjustedEndDateForAllowanceRules($businessTrip),
            $this->getStartDateExclusion(
                $businessTrip->startDate
            )
        );
    }

    private function getStartDateExclusion(DateTimeInterface $startDate): int
    {
        return (int) self::isTimePastHour(
            $startDate,
            24 - $this->minimumHoursForAllowance,
        );
    }

    /**
     * @throws Exception
     */
    private function getAdjustedEndDateForAllowanceRules(
        BusinessTrip $businessTrip
    ): DateTimeInterface {
        return new DateTime($businessTrip->endDate->format(self::DATE_FORMAT_STRING) . (
            !self::isTimePastHour(
                $businessTrip->endDate,
                $this->minimumHoursForAllowance
            )
                ? ' ' . DateTime::createFromInterface($businessTrip->startDate)
                    ->modify('+1 minutes')->format(self::TIME_FORMAT_STRING)
                : ''
            ));
    }

    private static function isTimePastHour(DateTimeInterface $date, int $hour): bool
    {
        return ((int) $date->format('H')) >= $hour;
    }
}