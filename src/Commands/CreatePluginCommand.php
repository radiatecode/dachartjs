<?php


namespace RadiateCode\DaChart\Commands;


use Illuminate\Console\GeneratorCommand;

class CreatePluginCommand extends GeneratorCommand
{

    /**
     * The name and signature of the console command.
     */
    protected $signature = 'make:chartplugin {name : Determines the plugin name}';

    /**
     * The console command description.
     */
    protected $description = 'Create a new plugin class to manipulate chart';

    /**
     * The type of class being generated.
     */
    protected $type = 'Plugin';

    /**
     * Gets the stub to generate the chart.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__.'/stubs/plugin.stub';
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
        return $rootNamespace . '\Charts\Plugins';
    }

    /**
     * Determines the name of the stub to generate.
     */
    protected function getNameInput()
    {
        return trim($this->argument('name'));
    }
}