<?php

declare(strict_types=1);

namespace Lib\MyAmazingFramework\AutoWire;

use Lib\MyAmazingFramework\MyConfig;
use Lib\MyAmazingFramework\MyFactory;
use ReflectionException;
use ReflectionMethod;
use RuntimeException;

final class MyAutoWire
{
    public function __construct(private MyConfig $config)
    {
    }

    /**
     * @throws RuntimeException
     */
    public function create(string $className): ?object
    {
        if ($this->config->hasAlias($className)) {
            $className = $this->config->alias($className);
        }

        if (!$this->config->hasFactory($className)) {
            throw new RuntimeException("No factory found for {$className}");
        }

        $factoryName = $this->config->factory($className);

        if ($factoryName !== self::class) {
            /** @var MyFactory $factory */
            $factory = new $factoryName;

            return $factory->create($this->config);
        }

        try {
            $reflection = new ReflectionMethod($className, '__construct');
        } catch (ReflectionException $e) {
            return new $className();
        }

        $arguments = [];
        foreach ($reflection->getParameters() as $parameter) {
            $arguments[] = $this->create((string)$parameter->getType());
        }

        return new $className(...$arguments);
    }
}
