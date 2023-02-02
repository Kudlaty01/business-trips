<?php

namespace App\Domain\BusinessTrip\Service\Allowance\AllowanceModifier;

use App\Domain\BusinessTrip\Model\Allowance;

interface AllowanceModifierInterface
{
    public function getModifierStartDay(): int;

    public function modifyAllowance(Allowance $allowance): float;

    public function setNext(AllowanceModifierInterface $nextAllowanceModifier
    ): AllowanceModifierInterface;
}