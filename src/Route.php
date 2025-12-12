<?php

namespace ErisonWork\SlimBumpShowcase;

use Psr\Http\Message\ResponseInterface;
use Slim\Route as RouteBase;

class Route extends RouteBase
{
    /**
     * @return bool
     **/
    public function dispatch()
    {
        foreach ($this->middleware as $mw) {
            call_user_func_array($mw, [$this]);
        }

        $return = call_user_func_array($this->getCallable(), array_values($this->getParams()));

        if ($return instanceof ResponseInterface) {
            $return->getBody()->rewind();
            echo $return->getBody()->getContents();
        } elseif (is_string($return)) {
            echo $return;
        }

        return (false === $return) ? false : true;
    }
}
