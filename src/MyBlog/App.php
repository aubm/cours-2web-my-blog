<?php

namespace MyBlog;

use MyBlog\Router\Route;
use MyBlog\Router\Router;

class App
{
    /** @var Router */
    private $router;

    public function handleRequest()
    {
        $request_path = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '/';
        $current_route = $this->router->getRouteFromRequestPath($request_path);

        if ($current_route === null) {
            echo 'Page not found';
            http_response_code(404);
            exit();
        }

        $handler_class_name = $current_route->getHandlerName();
        $handler_instance = new $handler_class_name;
        $handler_instance->{$current_route->getHandlerMethod()} ();
    }

    public function initRouterWithConfig(array $routes_data)
    {
        $router = new Router();
        foreach ($routes_data as $data) {
            $route = new Route();
            $route->setPath($data['path']);
            $route->setHandlerName($data['handler_name']);
            $route->setHandlerMethod($data['handler_method']);

            $router->registerRoute($route);
        }

        $this->router = $router;
    }
}