<?php


namespace DaCode\DaChart;

use DaCode\DaChart\Abstracts\BaseOption;
use Illuminate\Support\Arr;
use DaCode\DaChart\Contracts\Plugin;

class OptionBuilder
{
    /**
     * @var BaseOption $option
     */
    private $option;

    /**
     * @var array
     */
    private $attributes = [];

    /**
     * Resolve option class with option's __construct args
     *
     * @param  string  $class
     * @param  array   $params
     *
     * @return $this
     */
    public function option(string $class, array $params = []): OptionBuilder
    {
        if (class_exists($class)) {
            $this->option = new $class($params);

            $this->process();

            return $this;
        }

        throw new \TypeError('Argument 1 must be a class path!');
    }

    /**
     * Process the attributes of the option class
     */
    private function process(): void
    {
        $key = $this->option->rootKey();

        $attributes = $this->option->getAttributes();

        if ($this->isPlugin()) {
            $this->attributes['plugins'][$key] = Arr::get($attributes, $key);

            return;
        }

        $this->attributes[$key] = Arr::get($attributes, $key);
    }

    /**
     * Check whether the option is plugin or not
     *
     * @return bool
     */
    private function isPlugin(): bool
    {
        return $this->option instanceof Plugin;
    }

    /**
     * Render the attributes
     *
     * @return array
     */
    public function render(): array
    {
        return $this->attributes;
    }
}