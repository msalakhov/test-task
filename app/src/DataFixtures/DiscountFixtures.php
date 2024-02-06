<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Discount\Discount;
use App\Entity\Discount\DiscountType;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class DiscountFixtures extends Fixture
{
    private const ITEMS_TO_CREATE = 5;

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for ($i = 1; $i <= self::ITEMS_TO_CREATE; $i++) {
            $discount = (new Discount())
                ->setCode(
                    strtoupper(
                        sprintf(
                            '%s%d',
                            $faker->lexify('?'),
                            $faker->numerify('##')
                        )
                    )
                )
                ->setDiscountType($faker->randomElement(DiscountType::LIST))
                ->setAmount($faker->numberBetween(max: 90));

            print_r('generated coupon ' . $discount->getCode() . "\n");

            $manager->persist($discount);
        }

        $manager->flush();
    }
}
