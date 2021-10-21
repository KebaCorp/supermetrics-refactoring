<?php

declare(strict_types=1);

namespace Lib\MyOrm;

use Exception;
use PDO;

final class MyUnitOfWork
{
    private static ?self $instance = null;
    private PDO $pdo;

    private function __construct(MyDbConfig $config)
    {
        $this->pdo = new PDO(
            "pgsql:host={$config->host};port={$config->port};dbname={$config->dbname};",
            $config->username,
            $config->password,
        );
    }

    private function __clone()
    {
    }

    /**
     * @throws Exception
     */
    public function __wakeup()
    {
        throw new Exception("Cannot unserialize a singleton.");
    }

    public static function getInstance(MyDbConfig $config): self
    {
        if (null === self::$instance) {
            self::$instance = new self($config);
        }

        return self::$instance;
    }

    public function repository(string $tableName, string $className): MyRepository
    {
        return new MyRepository($this->pdo, $tableName, $className);
    }
}
