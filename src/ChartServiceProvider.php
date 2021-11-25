<?php


namespace RadiateCode\DaChart;

use RadiateCode\DaChart\Commands\CreateChartCommand;
use RadiateCode\DaChart\Data\Dataset;
use Illuminate\Support\ServiceProvider;
use RadiateCode\DaChart\Html\Builder;
use RadiateCode\DaChart\Response\ChartResponse;

class ChartServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('html.builder',function ($app){
            return $this->app->make(Builder::class);
        });

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