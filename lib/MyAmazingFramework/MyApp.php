<?php

declare(strict_types=1);

namespace Lib\MyAmazingFramework;

use Lib\MyAmazingFramework\AutoWire\MyAutoWire;
use Lib\MyAmazingFramework\Request\MyRequest;
use Lib\MyAmazingFramework\Response\MyJsonResponse;
use Throwable;

final class MyApp
{
    public function __construct(private MyConfig $config)
    {
    }

    public function run(): string
    {
        $request = new MyRequest();
        $url = $request->url();

        if (!$this->config->hasRoute($url)) {
            return MyJsonResponse::error(
                MyJsonResponse::HTTP_NOT_FOUND,
                "Route {$request->url()} not found."
            );
        }

        $route = $this->config->route($url);

        $autoWire = new MyAutoWire($this->config);
        $controller = $autoWire->create($route->controller());

        try {
            /** @var MyJsonResponse $response */
            $response = $controller->{$route->action()}($request);
        } catch (Throwable $e) {
            return MyJsonResponse::error($e->getCode(), $e->getMessage());
        }

        return $response->success();
    }
}
