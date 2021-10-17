<?php


use App\Application\Dto\Assembler;
use App\Application\Service\User\ViewUserService;
use App\Bridge\MyAmazingFramework\Controller\PublicApi\UserController;
use App\Domain\User\UserRepository;
use App\Infrastructure\MyOrm\Repository\OrmUserRepository;
use Lib\MyAmazingFramework\AutoWire\MyAutoWire;
use Lib\MyOrm\MyUnitOfWork;
use Lib\MyOrm\MyUnitOfWorkFactory;

return [
    'routes' => [
        'users' => [
            'controller' => UserController::class,
            'action' => 'view'
        ]
    ],
    'factories' => [
        MyUnitOfWork::class => MyUnitOfWorkFactory::class,
        ViewUserService::class => MyAutoWire::class,
        OrmUserRepository::class => MyAutoWire::class,
        UserController::class => MyAutoWire::class,
        Assembler::class => MyAutoWire::class,
    ],
    'aliases' => [
        UserRepository::class => OrmUserRepository::class,
    ],
    'db' => [
        'host' => getenv('POSTGRES_HOST'),
        'port' => getenv('POSTGRES_PORT'),
        'dbname' => getenv('POSTGRES_DBNAME'),
        'username' => getenv('POSTGRES_USERNAME'),
        'password' => getenv('POSTGRES_PASSWORD'),
    ],
];
