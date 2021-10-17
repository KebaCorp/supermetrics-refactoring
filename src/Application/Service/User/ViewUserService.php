<?php

declare(strict_types=1);

namespace App\Application\Service\User;

use App\Application\Dto\Assembler;
use App\Application\Dto\Phone\GetUserDto;
use App\Application\Dto\Phone\ViewUserDto;
use App\Application\Exception\User\UserNotFound;
use App\Domain\User\UserRepository;

final class ViewUserService
{
    public function __construct(
        private UserRepository $users,
        private Assembler $assembler,
    ) {
    }

    public function execute(GetUserDto $dto): ViewUserDto
    {
        $user = $this->users->byEmail($dto->email());

        if (null === $user) {
            throw UserNotFound::byEmail($dto->email());
        }

        return $this->assembler->toViewUserDto($user);
    }
}
