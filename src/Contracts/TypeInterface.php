<?php


namespace RadiateCode\DaChart\Contracts;


interface TypeInterface
{
    public function type(): string;

    public function options(): array;

    public function customOptions(array $options);

    public function changeDefaultOption(string $key,string $value);
}