<?php


namespace RadiateCode\DaChart\Abstracts;


use RadiateCode\DaChart\Contracts\TypeInterface;
use ErrorException;
use Illuminate\Support\Arr;
use InvalidArgumentException;
use RadiateCode\DaChart\Options\General;

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
     * @throws ErrorException
     */
    public function changeDefaultOption(
        string $key,
        string $value
    ): TypeInterface {
        $options = $this->defaultOptions();

        if (is_null(Arr::get($options, $key))) {
            throw new ErrorException('Given key is not found in the default options');
        }

        $this->modifyOptions[$key] = $value;

        return $this;
    }

    /**
     * apply default options
     */
    private function applyDefaultOptions(): array
    {
        $options = $this->defaultOptions();

        // modify default options if found any
        if ( ! empty($this->modifyOptions)) {
            foreach ($this->modifyOptions as $key => $value) {
                Arr::set($options, $key, $value);
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
        return General::OPTIONS;

    }
}