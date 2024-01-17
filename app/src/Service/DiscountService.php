<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\Discount\Discount;
use App\Entity\Discount\DiscountType;
use Exception;

use function bcmul;
use function bcdiv;

class DiscountService
{
    public function calculateDiscount(string $price, Discount $discount): string
    {
        $discountType = $discount->getDiscountType();
        $discountAmount = $discount->getAmount();

        if ($discountType === DiscountType::PERCENT) {
            return bcmul($price, (string) $discountAmount);
        }

        if ($discountType === DiscountType::FIXED) {
            return bcdiv($price, (string) $discountAmount);
        }

        throw new Exception('Unknown discount type');
    }
}
