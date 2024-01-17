<?php

namespace App\Dto;

class BaseDto
{
    public int $product;
    public string $taxNumber;
    public ?string $couponCode;
}