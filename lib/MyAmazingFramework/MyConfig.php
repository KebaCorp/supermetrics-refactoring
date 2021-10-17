<?php

declare(strict_types=1);

namespace Lib\MyAmazingFramework;

final class MyConfig
{
    private array $routes;
    private array $factories;
    private array $aliases;
    private array $db;

    public static function fromArray(array $params): self
    {
        $config = new self();

        if (is_array($params['routes'])) {
            $config->routes = $params['routes'];
        }

        if (is_array($params['factories'])) {
            $config->factories = $params['factories'];
        }

        if (is_array($params['aliases'])) {
            $config->aliases = $params['aliases'];
        }

        if (is_array($params['db'])) {
            $config->db = $params['db'];
        }

        return $config;
    }

    public function routes(): array
    {
        return $this->routes;
    }

    public function hasRoute(string $route): bool
    {
        return isset($this->routes[$route]) && is_array($this->routes[$route]);
    }

    public function route(string $route): ?MyRoute
    {
        if (!$this->hasRoute($route)) {
            return null;
        }

        $route = $this->routes[$route];

        if (!isset($route['controller']) ||
            !is_string($route['controller']) ||
            !isset($route['action']) ||
            !is_string($route['action'])
        ) {
            return null;
        }

        return new MyRoute($route['controller'], $route['action']);
    }

    public function factories(): array
    {
        return $this->factories;
    }

    public function hasFactory(string $className): bool
    {
        return isset($this->factories[$className]);
    }

    public function factory(string $className): ?string
    {
        return $this->factories[$className] ?? null;
    }

    public function aliases(): array
    {
        return $this->aliases;
    }

    public function hasAlias(string $className): bool
    {
        return isset($this->aliases[$className]);
    }

    public function alias(string $className): ?string
    {
        return $this->aliases[$className] ?? null;
    }

    public function db(): array
    {
        return $this->db;
    }
}
