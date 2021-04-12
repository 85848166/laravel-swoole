<?php

namespace ShineYork\LaravelExtend\Swoole\Server;

use Illuminate\Contracts\Container\Container;

use ShineYork\LaravelExtend\Swoole\Http\SRequest;
use ShineYork\LaravelExtend\Swoole\Http\SResponse;

// swoole的服务类
// swoole服务的管理
class Manager
{
    // 事件 =>只是服务中某一个点
    // swoole oop 编程方式

    // 对于swoole的事件处理
    // 启动的操作
    // 保存laravel - application


    /**
     * 保存swoole服务
     * @var \Swoole\Http\Server | \Swoole\WebSocket\Server
     */
    protected $server;

    /**
     * laravel的应用程序Application
     * @var [type]
     */
    protected $laravel;

    /**
     * swoole事件
     * @var [type]
     */
    protected $events = [
        'http' => [
            // swoole监听事件 => 当前这个类中对应监听的方法
            'request' => 'onRequest'
        ],
        'websocket' => [],
    ];

    public function __construct(Container $laravel)
    {
        $this->laravel = $laravel;
        // ... 获取swoole的服务
        $this->server = $this->laravel->make('extend.swoole_server');
        // ... 设置swoole的监听函数
        $this->setSwooleServerEvent();
    }

    protected function setSwooleServerEvent()
    {
        // .. 判断类型
        $type = config('extend.swoole.socket_type') ? 'http' : 'websocket';
        // var_dump($type);
        foreach ($this->events[$type] as $event => $func) {
            $this->server->on($event, [$this, $func]);
        }
    }

    public function onRequest($swooleRequest, $swooleResponse)
    {
        try {
            $laravelRequest = SRequest::make($swooleRequest);
            // var_dump();
            $laravelResponse = $this->laravel->make(\Illuminate\Contracts\Http\Kernel::class)->handle($laravelRequest);
            // $swooleResponse->header("Content-Type", "text/html; charset=utf-8");
            // // 页面渲染
            SResponse::make($laravelResponse, $swooleResponse)->send();
            // $swooleResponse->end($laravelResponse->getContent());
        } catch (\Exception $e) {
            $swooleResponse->end($e);
        }

    }

    public function run()
    {
        $this->server->start();
    }
}
