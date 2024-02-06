<?php

namespace App\ApiResource;

use ApiPlatform\Metadata\Post;
use App\Dto\CalculatePriceDto;
use App\Handler\CalculatePriceHandler;

#[Post(
    uriTemplate: '/calculate-price',
    description: 'Calculate price',
    input: CalculatePriceDto::class,
    processor: CalculatePriceHandler::class
)]
class CalculatePrice
{
}
