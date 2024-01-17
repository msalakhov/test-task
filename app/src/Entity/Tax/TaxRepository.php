<?php

declare(strict_types=1);

namespace App\Entity\Tax;

use Doctrine\ORM\EntityNotFoundException;

interface TaxRepository
{
    /**
     * @throws EntityNotFoundException
     */
    public function getAmountByTaxNumber(string $taxNumber): string;
}
