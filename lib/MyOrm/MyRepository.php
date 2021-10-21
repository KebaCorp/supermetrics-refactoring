<?php

declare(strict_types=1);

namespace Lib\MyOrm;

use PDO;
use PDOException;
use RuntimeException;

final class MyRepository
{
    public function __construct(
        private PDO $pdo,
        private string $tableName,
        private string $className,
    )
    {
    }

    /**
     * @throws PDOException
     * @throws RuntimeException
     */
    public function findOneBy($field, $value): ?object
    {
        $query = "SELECT * FROM {$this->tableName} WHERE {$field} = :val LIMIT 1";

        $prepared = $this->pdo->prepare($query);

        if (!$prepared) {
            throw new RuntimeException('Data preparation error.');
        }

        $prepared->bindParam(':val', $value);

        $result = $prepared->execute();

        if (!$result) {
            return null;
        }

        $object = $prepared->fetchObject($this->className);

        if (!$object) {
            return null;
        }

        return $object;
    }
}
