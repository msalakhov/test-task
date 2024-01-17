<?php

namespace App\Service;

final class PaypalPaymentProcessor implements PaymentProcessor
{
    public function __construct(private \Systemeio\TestForCandidates\PaymentProcessor\PaypalPaymentProcessor $paymentProcessor)
    {
    }

    public function pay(string $amount): bool
    {
        $this->paymentProcessor->pay((int) $amount);

        return true;
    }
}