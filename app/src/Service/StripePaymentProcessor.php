<?php

namespace App\Service;

/**
 * @final
 */
class StripePaymentProcessor implements PaymentProcessor
{
    public function __construct(private \Systemeio\TestForCandidates\PaymentProcessor\StripePaymentProcessor $paymentProcessor)
    {
    }

    /**
     * @inheritDoc
     */
    public function pay(string $amount): bool
    {
        return $this->paymentProcessor->processPayment((float) $amount);
    }
}
