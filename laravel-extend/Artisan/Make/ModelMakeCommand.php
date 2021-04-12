<?php

namespace ShineYork\LaravelExtend\Artisan\Make;

use Illuminate\Foundation\Console\ModelMakeCommand as Commad;
use Symfony\Component\Console\Input\InputOption;
use Illuminate\Support\Str;

class ModelMakeCommand extends Commad
{
    use GeneratorCommand;

    protected $name = 'extend-make:model';

    protected $namespaceSuffix = "\Models";

    protected function createMigration()
    {
        $table = Str::snake(Str::pluralStudly(class_basename($this->argument('name'))));

        if ($this->option('pivot')) {
            $table = Str::singular($table);
        }

        $this->call('extend-make:migration', [
            'name' => "create_{$table}_table",
            '--create' => $table,
            '--path' => $this->getPackageInput()
        ]);
    }

}
