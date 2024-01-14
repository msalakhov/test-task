<?php

declare(strict_types=1);

namespace App\Entity\Discount;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\Choice;

#[ORM\Entity]
#[ORM\Index(fields: ['code'])]
class Discount
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id;

    #[ORM\Column(type: 'string')]
    private string $code;

    #[ORM\Column(type: 'string')]
    #[Choice(choices: DiscountType::LIST, message: 'Choice a valid discount type')]
    private string $discountType;

    #[ORM\Column(type: 'decimal', options: ['precision' => 5, 'scale' => 2])]
    private int $amount;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getDiscountType(): string
    {
        return $this->discountType;
    }

    public function setDiscountType(string $discountType): self
    {
        $this->discountType = $discountType;

        return $this;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }

    public function setAmount(int $amount): self
    {
        $this->amount = $amount;

        return $this;
    }
}
