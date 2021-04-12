<?php

namespace ShineYork\LaravelExtend\Artisan\Make;

use Illuminate\Support\Str;
use Illuminate\Console\GeneratorCommand as Commad;

class EAMakeCommand extends Commad
{
    protected $packagePath = __DIR__.'/../../..';

    protected $signature = 'extend-make:make {name}';

    protected $description = '为Extend 创建Artisan 的 Make命令';

    protected $type = 'Make';

    protected function getStub()
    {
        return __DIR__.'/stubs/make.stub';
    }

    protected function rootNamespace()
    {
        return "ShineYork\\LaravelShop\\Extend\\Artisan\\Make";
    }

    protected function getPath($name)
    {
        $name = Str::replaceFirst($this->rootNamespace(), '', $name);
        return $this->packagePath.'/Extend/Artisan/Make'.str_replace('\\', '/', $name).'.php';
    }
}
