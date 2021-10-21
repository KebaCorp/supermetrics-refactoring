<?php

declare(strict_types=1);

namespace App\Domain\User;

final class User
{
    private int $id;
    private string $email;

    public function id(): int
    {
        return $this->id;
    }

    public function email(): string
    {
        return $this->email;
    }
}
