<?php


namespace RadiateCode\DaChartjs\Commands;


use Illuminate\Console\GeneratorCommand;

class CreateChartCommand extends GeneratorCommand
{

    /**
     * The name and signature of the console command.
     */
    protected $signature = 'make:dachartjs {name : Determines the chart name}';

    /**
     * The console command description.
     */
    protected $description = 'Create a new chart class';

    /**
     * The type of class being generated.
     */
    protected $type = 'Chart';

    /**
     * Gets the stub to generate the chart.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__.'/stubs/chart.stub';
    }

    /**
     * Get the default namespace for the class.
     * this help to create a folder based on namespace
     *
     * @param string $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Charts';
    }

    /**
     * Determines the name of the stub to generate.
     */
    protected function getNameInput()
    {
        return trim($this->argument('name'));
    }
}