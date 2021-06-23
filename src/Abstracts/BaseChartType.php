<?php


namespace DaCode\DaChart\Abstracts;


use DaCode\DaChart\Contracts\TypeInterface;
use DaCode\DaChart\Facades\OptionBuilder as Builder;
use DaCode\DaChart\OptionBuilder;
use DaCode\DaChart\Options\Legend;
use DaCode\DaChart\Options\Responsive;
use DaCode\DaChart\Options\Title;
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

        $call = call_user_func($callback);

        if ($call instanceof OptionBuilder) {
            $this->customOptions = $call->render();

            return $this;
        }

        if (is_array($call)) {
            $this->customOptions = $call;

            return $this;
        }

        throw new InvalidArgumentException(
            'Callback function should be return a object of option builder or an array!'
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
        return Builder::option(Responsive::class)
            ->option(Legend::class)
            ->option(Title::class, ['text' => 'My Chart'])
            ->render();
    }
}