<?php

declare(strict_types=1);

namespace Lib\MyOrm;

use Lib\MyAmazingFramework\MyConfig;
use Lib\MyAmazingFramework\MyFactory;

final class MyUnitOfWorkFactory implements MyFactory
{
    public function create(MyConfig $config): object
    {
        return MyUnitOfWork::getInstance(MyDbConfig::fromArray($config->db()));
    }
}
