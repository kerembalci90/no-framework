<?php declare(strict_types=1);

define('ROOT_DIR', dirname(__DIR__));

REQUIRE ROOT_DIR . '/vendor/autoload.php';

use Tracy\Debugger as TracyDebugger;
use Symfony\Component\HttpFoundation\Request as SymfonyRequest;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

TracyDebugger::enable();

$request = SymfonyRequest::createFromGlobals();

$content = 'Hello ' . $request->query->get('name', 'visitor');

$response = new SymfonyResponse($content);
$response->prepare($request);
$response->send();