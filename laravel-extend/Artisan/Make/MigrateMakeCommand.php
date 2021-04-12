<?php

namespace ShineYork\LaravelExtend\Artisan\Make;

use Illuminate\Database\Console\Migrations\MigrateMakeCommand as Commad;

class MigrateMakeCommand extends Commad
{
    use GeneratorCommand;

    protected $signature = 'extend-make:migration {name : The name of the migration}
        {--create= : The table to be created}
        {--table= : The table to migrate}
        {--path= : The location where the migration file should be created}
        {--realpath : Indicate any provided migration file paths are pre-resolved absolute paths}
        {--fullpath : Output the full path of the migration}';

     protected function getMigrationPath()
     {
          return $this->packagePath.'/'.$this->input->getOption('path').'/Database/'.'migrations';
     }
}
