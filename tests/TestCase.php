<?php


namespace RadiateCode\DaChartjs\tests;


use RadiateCode\DaChartjs\ChartServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    protected function getPackageProviders($app)
    {
        return [ChartServiceProvider::class];
    }

    protected function getEnvironmentSetUp($app)
    {

    }
}