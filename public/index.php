<?php

use Lib\DotEnv\DotEnv;
use Lib\MyAmazingFramework\MyApp;
use Lib\MyAmazingFramework\MyConfig;

require_once dirname(__DIR__) . '/vendor/autoload.php';

(new DotEnv(__DIR__ . '/../.env'))->load();

$config = require_once dirname(__DIR__) . '/config/config.php';

echo (new MyApp(MyConfig::fromArray($config)))->run();
