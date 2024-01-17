<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Tax\Tax;
use App\Entity\Tax\TaxRepository;
use App\Service\TaxService;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityNotFoundException;

class DoctrineTaxRepository implements TaxRepository
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private TaxService $taxService
    ) {
    }

    /**
     * @inheritDoc
     */
    public function getAmountByTaxNumber(string $taxNumber): string
    {
        $amount = $this
            ->entityManager
            ->getRepository(Tax::class)
            ->createQueryBuilder('t')
            ->select('t.amount')
            ->where('t.countryCode=:countryCode')
            ->setParameter('countryCode', $this->taxService->getCountryCodeFromTaxNumber($taxNumber))
            ->getQuery()
            ->getOneOrNullResult();

        if ($amount === null) {
            throw new EntityNotFoundException(sprintf('There is no tax which fits tax number: %s', $taxNumber));
        }

        return $amount['amount'];
    }
}
