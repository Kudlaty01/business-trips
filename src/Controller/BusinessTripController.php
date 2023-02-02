<?php

namespace App\Controller;

use App\Domain\BusinessTrip\Entity\BusinessTrip;
use App\Domain\BusinessTrip\Repository\BusinessTripRepository;
use App\Domain\BusinessTrip\Service\Allowance\AllowanceService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Annotation\Route;

#[AsController]
class BusinessTripController extends AbstractController
{
    public function __construct(
        private readonly AllowanceService $allowanceService,
        private readonly BusinessTripRepository $businessTripRepository
    ) {
    }

    #[Route('/business_trips', name: 'app_business_trip', methods: ['POST'])]
    public function __invoke(BusinessTrip $data): BusinessTrip
    {
        $businessTrip = $this->allowanceService->applyAllowance($data);
        $this->businessTripRepository->save($businessTrip, true);
        return $businessTrip;
    }
}
