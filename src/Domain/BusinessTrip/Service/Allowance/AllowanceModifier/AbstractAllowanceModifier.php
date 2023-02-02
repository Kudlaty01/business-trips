<?php

namespace App\Domain\BusinessTrip\Service\Allowance\AllowanceModifier;

use App\Domain\BusinessTrip\Model\Allowance;
use InvalidArgumentException;

abstract class AbstractAllowanceModifier implements AllowanceModifierInterface
{
    protected ?AllowanceModifierInterface $nextAllowanceModifier = null;

    public function __construct(
        readonly public int $modifierStartDay
    ) {
    }

    public function modifyAllowance(Allowance $allowance): float
    {
        return $allowance->dayOfBusinessTrip > $this->modifierStartDay
            ? $this->performModification($allowance)
            : $this->nextAllowanceModifier?->modifyAllowance($allowance)
            ?? $allowance->amount;
    }

    public function getModifierStartDay(): int
    {
        return $this->modifierStartDay;
    }

    abstract protected function performModification(Allowance $allowance
    ): float;

    public function setNext(
        AllowanceModifierInterface $nextAllowanceModifier
    ): AllowanceModifierInterface {
        if ($this->modifierStartDay > $nextAllowanceModifier->getModifierStartDay()) {
            throw new InvalidArgumentException('Modifier with lower starting day should not ' .
                'be placed before the other as it would be applied even though the modifier ' .
                'with higher starting day would also be applicable');
        }
        $this->nextAllowanceModifier = $nextAllowanceModifier;

        return $this;
    }
}