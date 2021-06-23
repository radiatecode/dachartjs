<?php


namespace DaCode\DaChart\Abstracts;


use DaCode\DaChart\Contracts\TypeInterface;
use ErrorException;
use Illuminate\Support\Arr;
use InvalidArgumentException;

abstract class BaseChartType implements TypeInterface
{
    private $customOptions = [];

    private $defaultOptions = [];

    public function __construct()
    {
        $this->defaultOptions = $this->defaultOptions();
    }

    public function options(): array
    {
        if ( ! empty($this->customOptions)) {
            return $this->customOptions;
        }

        return $this->defaultOptions;
    }

    public function customOptions($callback): TypeInterface
    {
        if ( ! is_callable($callback)) {
            throw new \TypeError('Argument should be a callback function!');
        }

        $options = call_user_func($callback);

        if (is_array($options)) {
            $this->customOptions = $options;

            return $this;
        }

        throw new InvalidArgumentException(
            'Callback function should be return an array!'
        );
    }

    /**
     * @throws ErrorException
     */
    public function changeDefaultOption(string $key,string $value): TypeInterface
    {
        if (is_null(Arr::get($this->defaultOptions,$key))){
            throw new ErrorException('Given key is not found in the default options');
        }

        Arr::set($this->defaultOptions,$key,$value);

        return $this;
    }

    protected function defaultOptions(): array
    {
        return [
            'responsive' => true,
            'plugins' => [
                'legend' => [
                    'display' => true,
                    'position' => 'top'
                ],
                'title' => [
                    'text' => 'My Chart',
                    'position' => 'top',
                    'display' => true,
                    'color' => 'black'
                ]
            ]
        ];
    }
}