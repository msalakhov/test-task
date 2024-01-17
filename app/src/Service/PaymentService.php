<?php

namespace App\Service;

final class PaymentService
{
    public function __construct(private PaymentProcessorFabric $paymentProcessorFabric)
    {
    }

    public function pay(string $amount, ?string $paymentProcessor): bool
    {
        return $this->paymentProcessorFabric->getPaymentProcessor($paymentProcessor)->pay($amount);
    }
}