<?php

declare(strict_types=1);

namespace App\Application\Exception\User;

use RuntimeException;

final class UserNotFound extends RuntimeException
{
    public static function byEmail(string $email): self
    {
        return new self("User by email {$email} not found.");
    }
}
