<?php

declare(strict_types=1);

namespace App\Tests\Service;

use App\Service\PaymentProcessorFabric;
use App\Service\PaypalPaymentProcessor;
use App\Service\StripePaymentProcessor;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class PaymentProcessorFabricTest extends KernelTestCase
{
    /**
     * @return mixed[]
     */
    public static function getPaymentProcessorDataProvider(): array
    {
        return [
            [
                'processor' => PaymentProcessorFabric::PAYPAL,
                'expectedProcessorClass' => PaypalPaymentProcessor::class,
            ],
            [
                'processor' => PaymentProcessorFabric::STRIPE,
                'expectedProcessorClass' => StripePaymentProcessor::class,
            ]
        ];
    }

    /**
     * @dataProvider getPaymentProcessorDataProvider
     */
    public function testGetPaymentProcessor(string $processor, string $expectedProcessorClass): void
    {
        $paymentProcessor = (new PaymentProcessorFabric())->getPaymentProcessor($processor);

        self::assertSame($expectedProcessorClass, $paymentProcessor::class);
    }
}
