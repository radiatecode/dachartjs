<?php


namespace RadiateCode\DaChart\Contracts;


interface ChartInterface
{
    public function getChartName(): string;

    public function render(): array;
}