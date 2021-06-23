<?php


namespace DaCode\DaChart\Contracts;


interface ChartInterface
{
    public function getChartName(): string;

    public function render(): array;
}