<?php

namespace ShineYork\LaravelExtend\Artisan\Make;

use Illuminate\Support\Str;
use Illuminate\Foundation\Console\ObserverMakeCommand as Commad;

class ObserverMakeCommand extends Commad
{
    use GeneratorCommand;

    protected $name = 'extend-make:observer';

    protected $namespaceSuffix = "\Observers";

    protected function replaceModel($stub, $model)
    {
        $model = str_replace('/', '\\', $model);

        // $namespaceModel = $this->laravel->getNamespace().$model;
        $namespaceModel = $this->packageRootNamespace().'Models\\'.$model;

        if (Str::startsWith($model, '\\')) {
            $stub = str_replace('NamespacedDummyModel', trim($model, '\\'), $stub);
        } else {
            $stub = str_replace('NamespacedDummyModel', $namespaceModel, $stub);
        }

        $stub = str_replace(
            "use {$namespaceModel};\nuse {$namespaceModel};", "use {$namespaceModel};", $stub
        );

        $model = class_basename(trim($model, '\\'));

        $stub = str_replace('DocDummyModel', Str::snake($model, ' '), $stub);

        $stub = str_replace('DummyModel', $model, $stub);

        return str_replace('dummyModel', Str::camel($model), $stub);
    }

}
