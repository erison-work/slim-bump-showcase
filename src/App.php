<?php

namespace ErisonWork\SlimBumpShowcase;

use Slim\App as BaseApp;
use Slim\Slim;

if (class_exists(Slim::class)) {
    final class App extends Slim
    {
        protected function mapRoute($args)
        {
            $pattern = array_shift($args);
            $callable = array_pop($args);
            $route = new Route($pattern, $callable, $this->settings['routes.case_sensitive']);
            $this->router->map($route);
            if (count($args) > 0) {
                $route->setMiddleware($args);
            }

            return $route;
        }
    }
} else {
    final class App extends BaseApp
    {
    }
}
