<?php

declare(strict_types=1);

namespace App\Application\Dto\Phone;

final class GetUserDto
{
    public function __construct(private string $email)
    {
    }

    public function email(): string
    {
        return $this->email;
    }
}
