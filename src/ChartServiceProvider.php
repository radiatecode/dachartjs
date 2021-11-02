<?php


namespace RadiateCode\DaChart;

use RadiateCode\DaChart\Data\Dataset;
use Illuminate\Support\ServiceProvider;
use RadiateCode\DaChart\Html\Builder;

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
    }

    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'dachart');
    }
}