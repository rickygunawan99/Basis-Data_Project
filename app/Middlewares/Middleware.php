<?php

namespace PHP\MVC\Middlewares;

interface Middleware
{
    public function before():void;
}