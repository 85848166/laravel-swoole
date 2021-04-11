<?php

namespace ShineYork\LaravelExtend\Artisan\Make;

use Illuminate\Routing\Console\ControllerMakeCommand as Command;
use Symfony\Component\Console\Input\InputArgument;


class ControllerMakeCommand extends Command
{
    use GeneratorCommand;

    protected $name = 'shop-make:controller  ';

    protected $namespaceSuffix = "\Http\Controllers";
}
