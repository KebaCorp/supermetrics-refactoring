<?php

declare(strict_types=1);

namespace Lib\MyAmazingFramework;

interface MyFactory
{
    public function create(MyConfig $config): object;
}
