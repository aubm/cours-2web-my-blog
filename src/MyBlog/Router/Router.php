<?php

namespace MyBlog\Router;

class Router
{
    /** @var Route[] */
    private $routes = [];

    public function registerRoute(Route $route)
    {
        $this->routes[] = $route;
    }

    /**
     * @return Route
     */
    public function getRouteFromRequestPath($request_path)
    {
        foreach ($this->routes as $route) {
            if ($route->getPath() === $request_path) {
                return $route;
            }
        }

        return null;
    }
}