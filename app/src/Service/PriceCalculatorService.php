<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\Discount\DiscountRepository;
use App\Entity\Product\ProductRepository;
use App\Entity\Tax\TaxRepository;
use function bcmul;
use function bcadd;

class PriceCalculatorService
{
    public function __construct(
        private DiscountService $discountService,
        private ProductRepository $productRepository,
        private TaxRepository $taxRepository,
        private DiscountRepository $discountRepository
    )
    {
    }

    public function calculatePrice(int $product, string $taxNumber, ?string $couponCode): string
    {
        $price = $this->productRepository->getById($product)->getPrice();
        $tax = $this->taxRepository->getAmountByTaxNumber($taxNumber);

        if ($couponCode !== null) {
            $price = $this->discountService->calculateDiscount(
                $price,
                $this->discountRepository->getByCouponCode($couponCode)
            );
        }

        $taxAmount = bcmul($price, bcdiv($tax, '100', 6), 8);

        return bcadd($price, $taxAmount);
    }
}
