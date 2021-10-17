<?php

declare(strict_types=1);

namespace Lib\MyAmazingFramework;

final class MyRoute
{
    public function __construct(private string $controller, private string $action)
    {
    }

    public function controller(): string
    {
        return $this->controller;
    }

    public function action(): string
    {
        return $this->action;
    }
}
