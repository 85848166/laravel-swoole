<?php

namespace ShineYork\LaravelExtend\Swoole\Console;

use Illuminate\Console\Command;
use ShineYork\LaravelExtend\Swoole\Server\Manager;

class HttpServerCommand extends Command
{
    // 做swoole启动
    // 执行完所有的请求
    // 启动,运行,关闭,初始化,重启
    //
    // 站在服务角度:启动,停止,重启,重新加载,服务信息
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'extend:swoole {action : start|stop|restart|reload|infos}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '这是一个操作与swoole的命令类';


    protected $manager;
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->manager = $this->laravel->make('extend.swoole_manager');
        // $this->laravel这是在 这个类中Illuminate\Console\Command的属性
        // $this->manager = new Manager($this->laravel);
        // PHP 是弱语言 -> 操作特别灵活
        // $this->info这是向控制台输出内容
        // $this->info();
        $this->execution();
    }


    protected function execution()
    {
        return $this->{$this->argument('action')}();
    }

    protected function start()
    {

        $this->manager->run();
        // return "start";
    }
    protected function stop()
    {
        return "stop";
    }
    protected function restart()
    {
        return "restart";
    }
    protected function reload()
    {
        return "reload";
    }
    protected function infos()
    {
        return "infos";
    }
}
