<?php

// config/routes.php
use App\Extend\Route;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

return static function (RoutingConfigurator $routeConfig): void {
    $routes = Route::$routes;
    foreach ($routes as $route) {
        $name = $route['name'] ?? "{$route['method']}.{$route['uri']}";
        $routeConfig->add($name, $route['uri'])->controller($route['controller'])->methods([$route['method']]);
    }
};
