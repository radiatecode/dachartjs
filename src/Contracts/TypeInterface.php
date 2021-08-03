<?php


namespace RadiateCode\DaChart\Contracts;


interface TypeInterface
{
    public function type(): string;

    public function options(): array;

    public function customOptions($callback);

    public function changeDefaultOption(string $key,string $value);
}