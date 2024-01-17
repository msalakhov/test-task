<?php

namespace App\Service;

interface PaymentProcessor
{
    public function pay(string $amount): bool;
}