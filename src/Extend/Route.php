<?php

namespace App\Extend;

use Closure;

class Route
{

    public static array $routes;

    public static function get($uri, $action): static
    {
        static::$routes[] = [
            'uri' => $uri,
            'controller' => $action,
            'method' => 'GET',
        ];

        return new static;
    }

    public static function post($uri, $action): static
    {
        static::$routes[] = [
            'uri' => $uri,
            'controller' => $action,
            'method' => 'POST',
        ];

        return new static;
    }

    public static function put($uri, $action): static
    {
        static::$routes[] = [
            'uri' => $uri,
            'controller' => $action,
            'method' => 'PUT',
        ];

        return new static;
    }

    public static function delete($uri, $action): static
    {
        static::$routes[] = [
            'uri' => $uri,
            'controller' => $action,
            'method' => 'DELETE',
        ];

        return new static;
    }

    public static function group(array $config, Closure $closure): void
    {
        $beforeRoutes = static::$routes;
        $closure();
        $afterRoutes = static::$routes;
        $routes = array_diff_key($afterRoutes, $beforeRoutes);

        foreach ($routes as $key => $route) {
            if (isset($config['prefix'])) {
                $uri = str_replace('/', '', static::$routes[$key]['uri']);
                static::$routes[$key]['uri'] = "{$config['prefix']}/$uri";
            }

            if (isset($config['as'])) {
                static::$routes[$key]['name'] = $config['as'].static::$routes[$key]['name'];
            }
        }
    }

    public static function name($name): void
    {
        static::$routes[array_key_last(static::$routes)]['name'] = $name;
    }

}