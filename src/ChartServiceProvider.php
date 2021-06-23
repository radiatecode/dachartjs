<?php


namespace DaCode\DaChart;

use DaCode\DaChart\Data\DatasetBuilder;
use Illuminate\Support\ServiceProvider;

class ChartServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('chart.builder',function ($app){
            return $this->app->make(ChartBuilder::class);
        });

        $this->app->singleton('dataset.builder',function ($app){
            return $this->app->make(DatasetBuilder::class);
        });
    }

    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'dachart');
    }
}