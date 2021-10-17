<?php

declare(strict_types=1);

namespace Lib\MyOrm;

final class MyDbConfig
{
    public string $host;
    public string $port;
    public string $dbname;
    public string $username;
    public string $password;

    public static function fromArray(array $params): self
    {
        $config = new self();
        $config->host = $params['host'] ?? '';
        $config->port = $params['port'] ?? '';
        $config->dbname = $params['dbname'] ?? '';
        $config->username = $params['username'] ?? '';
        $config->password = $params['password'] ?? '';

        return $config;
    }
}
