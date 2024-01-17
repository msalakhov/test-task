<?php

namespace App\ApiResource;

use ApiPlatform\Metadata\Post;
use App\Dto\PurchaseDto;
use App\Handler\PurchaseHandler;

#[Post(
    uriTemplate: '/purchase',
    description: 'Make purchase',
    input: PurchaseDto::class,
    processor: PurchaseHandler::class
)]
class Purchase
{
}