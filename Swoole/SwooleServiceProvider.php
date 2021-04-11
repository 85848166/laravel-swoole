<?php

namespace ShineYork\LaravelExtend\Swoole;

use Illuminate\Support\ServiceProvider;
use Swoole\Http\Server as SwooleHttpServer;
use Swoole\WebSocket\Server as SwooleWebSocket;


class SwooleServiceProvider extends ServiceProvider
{
    protected $command = [
         Console\HttpServerCommand::class,
    ];

    protected static $server;

    public function register()
    {
        $this->registerConfig();
        $this->registerSwooleServer();
        $this->commands($this->command);
    }

    public function boot()
    {

    }
    /**
     * 注册配置文件
     */
    protected function registerConfig()
    {
        $this->mergeConfigFrom(
            __DIR__.'/Config/swoole.php', 'extend.swoole'
        );
    }
    /**
     * 注册swoole的服务
     */
    protected function registerSwooleServer()
    {
        $this->app->singleton('swoole.server', function(){ // 吧swoole注册到laravel的ioc
            //.创建swoole
            if (is_null(static::$server)) { // 单一的原则
                // 创建swoole服务
                $this->createSwooleServer();
                // 配置swoole服务配置信息
                $this->configureSwooleServer();
            }
            return static::$server;
        });
    }
    /**
     * 创建swoole
     * 1. 获取配置文件
     * 2. 确定要创建服务类型
     * 3. 创建swoole
     * @return \Swoole\Http\Server | \Swoole\WebSocket\Server
     */
    private function createSwooleServer()
    {
        // 获取配置文件, 确定要创建服务类型
        $server = config('extend.swoole.socket_type') ? SwooleHttpServer::class : SwooleWebSocket::class;
        // 创建
        static::$server = new $server(config('extend.swoole.listen.host'), config('extend.swoole.listen.port'));
    }
    /**
     * 注意因为swoole的不同服务有不同的配置 所以需要设置
     */
    private function configureSwooleServer()
    {
        // .. 自个完善
        $config = config('extend.swoole.socket_type') ? config('extend.swoole.http')  : config('extend.swoole.websocket');
    }
}
