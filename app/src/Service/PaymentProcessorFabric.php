<?php

namespace App\Service;

class PaymentProcessorFabric
{
    public function getPaymentProcessor(?string $processor): PaymentProcessor
    {
        switch ($processor) {
            case 'paypal':
                return new PaypalPaymentProcessor(new \Systemeio\TestForCandidates\PaymentProcessor\PaypalPaymentProcessor());
            default:
                return new StripePaymentProcessor(new \Systemeio\TestForCandidates\PaymentProcessor\StripePaymentProcessor());
        }
    }
}
