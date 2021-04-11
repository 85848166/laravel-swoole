<?php

namespace ShineYork\LaravelExtend\Artisan;

use Illuminate\Support\ServiceProvider;

class ArtisanServiceProvider extends ServiceProvider
{
    protected $command = [
        Make\ClassMakeCommand::class,
        Make\ModelMakeCommand::class,
        Make\SeederMakeCommand::class,
        Make\EAMakeCommand::class,
        Make\MigrateMakeCommand::class,
        Make\ObserverMakeCommand::class,
        Make\ControllerMakeCommand::class

    ];

    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/Config/artisan.php', 'extend.artisan'
        );
        $this->commands($this->command);
    }

    public function boot()
    {

    }
}
