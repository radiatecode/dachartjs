<?php


namespace RadiateCode\DaChartjs;

use RadiateCode\DaChartjs\Commands\CreateChartCommand;
use RadiateCode\DaChartjs\Data\Dataset;
use Illuminate\Support\ServiceProvider;
use RadiateCode\DaChartjs\Html\Builder;
use RadiateCode\DaChartjs\Response\ChartResponse;

class ChartServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('dataset.builder',function ($app){
            return $this->app->make(Dataset::class);
        });

        $this->app->singleton('chart.response',function ($app){
            return $this->app->make(ChartResponse::class);
        });
    }

    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                CreateChartCommand::class
            ]);
        }

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'dachart');
    }
}