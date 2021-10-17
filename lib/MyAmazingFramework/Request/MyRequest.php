<?php

declare(strict_types=1);

namespace Lib\MyAmazingFramework\Request;

final class MyRequest
{
    public function param(string $key): mixed
    {
        return $_REQUEST[$key] ?? null;
    }

    public function url(): string
    {
        $requestUri = explode('/', trim($_SERVER['REQUEST_URI'], '/'));
        $scriptName = explode('/', trim($_SERVER['SCRIPT_NAME'], '/'));
        $parts = array_diff_assoc($requestUri, $scriptName);

        if (empty($parts)) {
            return '/';
        }

        $url = implode('/', $parts);
        $position = strpos($url, '?');

        if (false !== $position) {
            $url = substr($url, 0, $position);
        }

        return $url;
    }
}
