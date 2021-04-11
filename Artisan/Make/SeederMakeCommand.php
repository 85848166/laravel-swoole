<?php

namespace ShineYork\LaravelExtend\Artisan\Make;

use Illuminate\Database\Console\Seeds\SeederMakeCommand as Commad;
use Symfony\Component\Console\Input\InputArgument;

class SeederMakeCommand extends Commad
{
    use GeneratorCommand;

    protected $name = 'extend-make:seeder';

    protected function getPath($name)
    {
        return $this->packagePath.'/'.$this->getPackageInput().'/Database/seeds/'.$name.'.php';
    }
}
