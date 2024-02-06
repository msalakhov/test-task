<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Tax\Tax;
use App\Entity\Tax\TaxRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityNotFoundException;

class DoctrineTaxRepository implements TaxRepository
{
    public function __construct(
        private EntityManagerInterface $entityManager,
    ) {
    }

    /**
     * @inheritDoc
     */
    public function getAmountByCountryCode(string $countryCode): string
    {
        /** @var array<string, numeric-string> | null $amount */
        $amount = $this
            ->entityManager
            ->getRepository(Tax::class)
            ->createQueryBuilder('t')
            ->select('t.amount')
            ->where('t.countryCode=:countryCode')
            ->setParameter('countryCode', $countryCode)
            ->getQuery()
            ->getOneOrNullResult();

        if ($amount === null) {
            throw new EntityNotFoundException(sprintf('There is no tax for country code: %s', $countryCode));
        }

        return $amount['amount'];
    }
}
