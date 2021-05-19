<?php


class Route
{
    public static function start ()
    {
        $controller_name = 'Main';
        $action = 'index';

        $uri = $_SERVER['REQUEST_URI'];
        $uri = substr($uri, 1);
        if ($uri) $action = $uri;

        $controller_name = $controller_name.'Controller';
        $controller = new $controller_name();
        if (method_exists($controller, $action))
            $controller->$action();
        else
            $controller->error();
    }

}