<?php

declare(strict_types=1);

namespace App\Service;

class TaxService
{
    public function getCountryCodeFromTaxNumber(string $taxNumber): string
    {
        return substr($taxNumber, 0, 2);
    }
}
