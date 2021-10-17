<?php

declare(strict_types=1);

namespace App\Infrastructure\MyOrm\Repository;

use App\Domain\User\User;
use App\Domain\User\UserRepository;
use Lib\MyOrm\MyRepository;
use Lib\MyOrm\MyUnitOfWork;

final class OrmUserRepository implements UserRepository
{
    private string $tableName = 'users';
    private string $className = User::class;

    public function __construct(private MyUnitOfWork $uow)
    {
    }

    private function repository(): MyRepository
    {
        return $this->uow->repository($this->tableName, $this->className);
    }

    public function byEmail(string $email): ?User
    {
        /** @var User $user */
        $user = $this->repository()->findOneBy('email', $email);

        return $user;
    }
}
