<?php
return [
    'listen' => [
        'host' => env('SWOOLE_LISTEN_HOST', '0.0.0.0'),
        'port' => env('SWOOLE_LISTEN_PORT', 9501),
    ],
    // 基于laravel加速组件
    // true : 就是http类型的swoole服务 - web服务 | false : 就是websocket的swoole服务
    'socket_type' => true,
    'http' => [
        // ..
    ],
    'websocket' => [
        // ..
    ],
];
