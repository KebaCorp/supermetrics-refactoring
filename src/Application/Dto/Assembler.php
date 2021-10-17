<?php

declare(strict_types=1);

namespace App\Application\Dto;

use App\Application\Dto\Phone\ViewUserDto;
use App\Domain\User\User;

final class Assembler
{
    public function toViewUserDto(User $user): ViewUserDto
    {
        $dto = new ViewUserDto();
        $dto->id = $user->id();
        $dto->email = $user->email();

        return $dto;
    }
}
