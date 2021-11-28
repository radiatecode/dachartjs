<?php


namespace RadiateCode\DaChart\Abstracts;


use RadiateCode\DaChart\Contracts\TypeInterface;
use ErrorException;
use RadiateCode\DaChart\Enums\GeneralOption;

abstract class BaseChartType implements TypeInterface
{
    /**
     * @var array
     */
    private $customOptions = [];
    private $modifyOptions = [];

    /**
     * Get options
     *
     * @return array
     * @throws ErrorException
     */
    public function options(): array
    {
        if ( ! empty($this->customOptions)) {
            return $this->customOptions;
        }

        // if custom options not found then apply default options with changes (if any)
        return $this->applyDefaultOptions();
    }

    /**
     * Set custom options
     *
     * @param  array  $options
     *
     * @return TypeInterface
     */
    public function customOptions(array $options): TypeInterface
    {
        $this->customOptions = $options;

        return $this;
    }

    /**
     * Change any default option
     *
     */
    public function changeDefaultOption(string $key, string $value): TypeInterface
    {
        $this->modifyOptions[$key] = $value;

        return $this;
    }

    /**
     * apply default options
     *
     * @throws ErrorException
     */
    private function applyDefaultOptions(): array
    {
        $options = $this->defaultOptions();

        // modify default options if found any
        if ( ! empty($this->modifyOptions)) {
            foreach ($this->modifyOptions as $key => $value) {
                set_value_in_array_nested($options,$key, $value);
            }

            return $options;
        }

        return $options;
    }

    /**
     * Default options
     *
     * @return array
     */
    protected function defaultOptions(): array
    {
        return GeneralOption::OPTIONS;
    }
}