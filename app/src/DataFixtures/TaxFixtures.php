<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Tax\Tax;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TaxFixtures extends Fixture
{
    /**
     * @return mixed[]
     */
    private function fakeData(): array
    {
        return [
            [
                'countryCode' => 'DE',
                'mask' => 'DEXXXXXXXXX',
                'amount' => 19,
            ],
            [
                'countryCode' => 'IT',
                'mask' => 'ITXXXXXXXXXXX',
                'amount' => 22,
            ],
            [
                'countryCode' => 'GR',
                'mask' => 'GRXXXXXXXXX',
                'amount' => 24,
            ],
            [
                'countryCode' => 'FR',
                'mask' => 'FRYYXXXXXXXXX',
                'amount' => 20,
            ],
        ];
    }

    public function load(ObjectManager $manager): void
    {
        foreach ($this->fakeData() as $taxData) {
            $tax = (new Tax())
                ->setCountryCode($taxData['countryCode'])
                ->setMask($taxData['mask'])
                ->setAmount($taxData['amount']);

            $manager->persist($tax);
        }

        $manager->flush();
    }
}
