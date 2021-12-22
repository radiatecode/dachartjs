<?php


namespace RadiateCode\DaChartjs\Contracts;


interface ChartInterface
{
    public function getChartName(): string;

    public function render(): array;
}