<?php


namespace ShineYork\LaravelExtend\Swoole\Console;


use Illuminate\Console\Command;

class WebSocketCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'websocket:{action : start|stop|restart|reload|infos}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * @return int
     */
    public function handle()
    {
        $this->info($this->execution());
        return 0;
    }

    protected function execution()
    {
        return $this->{$this->argument('action')}();
    }

    protected function start()
    {
        return "start";
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