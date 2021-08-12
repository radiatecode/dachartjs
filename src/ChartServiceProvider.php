<?php


namespace RadiateCode\DaChart;

use RadiateCode\DaChart\Data\Dataset;
use Illuminate\Support\ServiceProvider;

class ChartServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('chart.builder',function ($app){
            return $this->app->make(ChartBuilder::class);
        });

        $this->app->singleton('dataset.builder',function ($app){
            return $this->app->make(Dataset::class);
        });
    }

    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'dachart');
    }
}