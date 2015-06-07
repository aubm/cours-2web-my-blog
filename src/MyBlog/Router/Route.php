<?php

namespace MyBlog\Router;

class Route
{
    private $path;
    private $handler_name;
    private $handler_method;

    /**
     * @return mixed
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param mixed $path
     */
    public function setPath($path)
    {
        $this->path = $path;
    }

    /**
     * @return mixed
     */
    public function getHandlerName()
    {
        return $this->handler_name;
    }

    /**
     * @param mixed $handler_name
     */
    public function setHandlerName($handler_name)
    {
        $this->handler_name = $handler_name;
    }

    /**
     * @return mixed
     */
    public function getHandlerMethod()
    {
        return $this->handler_method;
    }

    /**
     * @param mixed $handler_method
     */
    public function setHandlerMethod($handler_method)
    {
        $this->handler_method = $handler_method;
    }
}