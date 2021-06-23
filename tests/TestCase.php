<?php


namespace DaCode\DaChart\tests;


use DaCode\DaChart\ChartServiceProvider;

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