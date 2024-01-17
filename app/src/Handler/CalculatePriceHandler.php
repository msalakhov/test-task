<?php

declare(strict_types=1);

namespace App\Handler;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use App\Dto\CalculatePriceDto;
use App\Entity\Discount\DiscountRepository;
use App\Entity\Product\ProductRepository;
use App\Entity\Tax\TaxRepository;
use App\Service\PriceCalculatorService;

final class CalculatePriceHandler implements ProcessorInterface
{
    public function __construct(
        private PriceCalculatorService $calculatorService,
        private ProductRepository $productRepository,
        private TaxRepository $taxRepository,
        private DiscountRepository $discountRepository
    ) {
    }

    /**
     * @param CalculatePriceDto $data
     */
    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = [])
    {
        return $this->calculatorService->calculatePrice(
            (string) $this->productRepository->getById($data->product)->getPrice(),
            $this->taxRepository->getAmountByTaxNumber($data->taxNumber),
            $this->discountRepository->getByCouponCode($data->couponCode)
        );
    }
}
