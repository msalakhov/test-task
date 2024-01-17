<?php

namespace App\Handler;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use App\Dto\PurchaseDto;
use App\Entity\Discount\DiscountRepository;
use App\Entity\Product\ProductRepository;
use App\Entity\Tax\TaxRepository;
use App\Service\PaymentService;
use App\Service\PriceCalculatorService;

final class PurchaseHandler implements ProcessorInterface
{
    public function __construct(
        private PriceCalculatorService $calculatorService,
        private ProductRepository $productRepository,
        private TaxRepository $taxRepository,
        private DiscountRepository $discountRepository,
        private PaymentService $paymentService
    ) {
    }

    /**
     * @param PurchaseDto $data
     * @return bool
     */
    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = [])
    {
        $amount = $this->calculatorService->calculatePrice(
            (string) $this->productRepository->getById($data->product)->getPrice(),
            $this->taxRepository->getAmountByTaxNumber($data->taxNumber),
            $this->discountRepository->getByCouponCode($data->couponCode)
        );

        return $this->paymentService->pay($amount, $data->paymentProcessor);
    }
}
