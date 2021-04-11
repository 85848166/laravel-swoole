<?php

namespace ShineYork\LaravelExtend\Swoole\Facades;

use Illuminate\Support\Facades\Facade;

class SwooleServer extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'swoole.server';
    }
}
