<?php

declare(strict_types=1);

namespace App\Tests\Service;

use App\Entity\Tax\Tax;
use App\Entity\Tax\TaxRepository;
use App\Service\TaxService;
use Doctrine\ORM\EntityNotFoundException;
use PHPUnit\Framework\MockObject\MockObject;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class TaxServiceTest extends KernelTestCase
{
    /** @var TaxRepository | MockObject $taxRepository */
    private MockObject $taxRepository;

    protected function setUp(): void
    {
        $this->taxRepository = self::createMock(TaxRepository::class);

        parent::setUp();
    }

    public function testCalculateTaxAmount(): void
    {
        $taxNumber = 'DE123456789';
        $taxAmount = '19';
        $price = '250';
        $expectedTaxAmount = 47.5;

        (new Tax())
            ->setAmount($taxAmount)
            ->setCountryCode('DE');

        $this
            ->taxRepository
            ->expects(self::once())
            ->method('getAmountByCountryCode')
            ->willReturn($taxAmount);

        $calculatedTaxAmount = $this->getService()->calculateTaxAmount($price, $taxNumber);

        self::assertEquals($expectedTaxAmount, $calculatedTaxAmount);
    }

    public function testCalculateTaxAmountThrowsError(): void
    {
        $taxNumber = 'FR123456789';
        $taxAmount = '19';
        $price = '250';

        (new Tax())
            ->setAmount($taxAmount)
            ->setCountryCode('DE');

        $this
            ->taxRepository
            ->expects(self::once())
            ->method('getAmountByCountryCode')
            ->willThrowException(new EntityNotFoundException());

        self::expectException(EntityNotFoundException::class);

        $this->getService()->calculateTaxAmount($price, $taxNumber);
    }

    private function getService(): TaxService
    {
        return new TaxService($this->taxRepository);
    }
}
