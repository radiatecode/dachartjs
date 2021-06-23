<?php


namespace DaCode\DaChart;

use DaCode\DaChart\Data\Dataset;
use Illuminate\Support\ServiceProvider;

class ChartServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('chart.builder',function ($app){
            return $this->app->make(ChartBuilder::class);
        });

        $this->app->singleton('dataset',function ($app){
            return $this->app->make(Dataset::class);
        });
    }

    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'dachart');
    }
}