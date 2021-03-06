<?php


namespace RadiateCode\DaChartjs\Contracts;


interface TypeInterface
{
    public function type(): string;

    public function options();

    public function customOptions($options);

    public function changeDefaultOption(string $key,string $value);
}