<?php


namespace DaCode\DaChart\Abstracts;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;

abstract class BaseOption
{
    protected $attributes = [];

    protected $params = [];

    public function __construct(array $params = [])
    {
        $this->default();

        $this->params = $params;

        $this->customParams();
    }

    protected function customParams(): BaseOption
    {
        if (empty($this->params)){
            return $this;
        }

        $this->attributes = []; // reset the attributes

        foreach ($this->params as $key => $value){
            $this->set($key,$value);
        }

        return $this;
    }

    protected function set($key,$value): BaseOption
    {
        if (empty($key)){ // if found empty key then the value set as root key value
            $this->attributes = $value;

            return $this;
        }

        Arr::set($this->attributes,$key,$value);

        return $this;
    }

    public function rootKey(): string
    {
        return Str::camel(basename(static::class));
    }

    public function getAttributes(): array
    {
        return [
            $this->rootKey() => $this->attributes
        ];
    }

    abstract protected function default(): BaseOption;
}