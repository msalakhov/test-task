<?php

namespace App\ApiResource;

use ApiPlatform\Metadata\Post;
use App\Dto\CalculatePriceDto;
use App\Handler\CalculatePriceHandler;

#[Post(
    input: CalculatePriceDto::class,
    processor: CalculatePriceHandler::class
)]
class CalculatePrice
{
}
