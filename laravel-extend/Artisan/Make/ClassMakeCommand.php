<?php

namespace ShineYork\LaravelExtend\Artisan\Make;

use Illuminate\Console\GeneratorCommand as Commad;
use Illuminate\Support\Str;

class ClassMakeCommand extends Commad
{


    protected $signature = 'extend-make:class {name}';

    protected $description = '为laravel-shop快速创建一个类';

    protected $type = 'Class';

    protected function rootNamespace()
    {
        return config('extend.artisan.package.namespace');
    }
    public function getPackagePath()
    {
        return config('extend.artisan.package.path');
    }
    protected function getPath($name)
    {
        $name = Str::replaceFirst($this->rootNamespace(), '', $name);
        return $this->getPackagePath().str_replace('/', '\\', $name).'.php';
    }

    protected function getStub()
    {
        return __DIR__.'/stubs/class.stub';
    }

    protected function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of the class'],
        ];
    }
}
