<?php

namespace App\Service;

class PaymentProcessorFabric
{
    public const PAYPAL = 'paypal';
    public const STRIPE = 'stripe';
    public const LIST = [
        self::PAYPAL,
        self::STRIPE,
    ];

    public function getPaymentProcessor(?string $processor): PaymentProcessor
    {
        switch ($processor) {
            case self::PAYPAL:
                return new PaypalPaymentProcessor(new \Systemeio\TestForCandidates\PaymentProcessor\PaypalPaymentProcessor());
            default:
                return new StripePaymentProcessor(new \Systemeio\TestForCandidates\PaymentProcessor\StripePaymentProcessor());
        }
    }
}
