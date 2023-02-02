<?php

namespace App\Domain\BusinessTrip\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use App\Controller\BusinessTripController;
use App\Domain\BusinessTrip\Enums\Country;
use App\Domain\BusinessTrip\Repository\BusinessTripRepository;
use DateTimeInterface;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: BusinessTripRepository::class)]
#[ApiResource(operations: [
    new GetCollection(),
    new Get(),
    new Post(
        controller: BusinessTripController::class,
    ),
    new Delete(),
], normalizationContext: ['groups' => ['read']],
    denormalizationContext: ['groups' => ['write']],
)]
class BusinessTrip
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    #[ORM\Column]
    #[Groups(['read'])]
    private ?int $id = null;

    #[ORM\Column(length: 2, enumType: Country::class)]
    #[Assert\NotBlank]
    #[Groups(['read', 'write'])]
    public Country $country;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Assert\NotBlank]
    #[Groups(['read', 'write'])]
    public DateTimeInterface $startDate;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Assert\NotBlank]
    #[Groups(['read', 'write'])]
    public DateTimeInterface $endDate;

    #[ORM\Column(precision: 2, nullable: true)]
    #[Groups(['read'])]
    public ?float $allowance = null;

    public function getId(): ?int
    {
        return $this->id;
    }
}
