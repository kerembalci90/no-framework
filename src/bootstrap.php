<?php declare(strict_types=1);

define('ROOT_DIR', dirname(__DIR__));

REQUIRE ROOT_DIR . '/vendor/autoload.php';

use Tracy\Debugger;

Debugger::enable();

echo 'Hello from the bootstrap file :)';