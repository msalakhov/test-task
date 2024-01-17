<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\Discount\Discount;

use function bcmul;
use function bcadd;

class PriceCalculatorService
{
    public function __construct(private DiscountService $discountService)
    {
    }

    public function calculatePrice(string $price, string $tax, ?Discount $discount): string
    {
        if ($discount !== null) {
            $price = $this->discountService->calculateDiscount($price, $discount);
        }

        $taxAmount = bcmul($price, $tax, 8);

        return bcadd($price, $taxAmount);
    }
}
