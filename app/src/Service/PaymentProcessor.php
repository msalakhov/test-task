<?php

namespace App\Service;

interface PaymentProcessor
{
    /** @param numeric-string $amount */
    public function pay(string $amount): bool;
}
