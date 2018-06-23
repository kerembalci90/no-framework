<?php declare(strict_types=1);

define('ROOT_DIR', dirname(__DIR__));
REQUIRE ROOT_DIR . '/vendor/autoload.php';

use Tracy\Debugger as TracyDebugger;
use Symfony\Component\HttpFoundation\Request as Request;
use Symfony\Component\HttpFoundation\Response as Response;
use FastRoute as FastRoute;
use FastRoute\RouteCollector as RouteCollector;
use FastRoute\Dispatcher as Dispatcher;

TracyDebugger::enable();

$request = Request::createFromGlobals();

$dispatcher = FastRoute\simpleDispatcher(
    function (RouteCollector $r) {
        $routes = include(ROOT_DIR . '/src/Routes.php');
        foreach ($routes as $route)
        {
            $r->addRoute(...$route);
        }
    }
);

$routeInfo = $dispatcher->dispatch(
    $request->getMethod(),
    $request->getPathInfo()
);

switch ($routeInfo[0]) {
    case Dispatcher::NOT_FOUND:
        $response = new Response('Not Found', 404);
        break;
    case Dispatcher::METHOD_NOT_ALLOWED:
        $response = new Response('Not Allowed', 405);
        break;
    case Dispatcher::FOUND:
        [$controllerName, $method] = explode('#', $routeInfo[1]);
        $vars = $routeInfo[2];

        $controller = new $controllerName;
        $response = $controller->$method($request, $vars);
        break;
}

if(!$response instanceof Response)
{
    throw new \Exception("Controller methods must return a Response object");
}

$response->prepare($request);
$response->send();