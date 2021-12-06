<?php


namespace RadiateCode\DaChart\Abstracts;


use InvalidArgumentException;
use RadiateCode\DaChart\Contracts\TypeInterface;
use ErrorException;
use RadiateCode\DaChart\Enums\GeneralOption;

abstract class BaseChartType implements TypeInterface
{
    private $customOptions = null;
    private $modifyOptions = [];

    /**
     * Get options
     *
     * @return array|string
     *
     * @throws ErrorException
     */
    public function options()
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
     * [Note: Customer options could be php array or raw json string]
     *
     * @param  $options
     *
     * @return TypeInterface
     */
    public function customOptions($options): TypeInterface
    {
        // $jsonString = preg_replace("/\s+/", "", $options); // tab, new line space remove from raw json

        $type = gettype($options);

        if (! in_array($type,['array','string'])){
            throw new InvalidArgumentException('Custom options must be array or json string! '.$type." given");
        }

        $this->customOptions = $options;

        return $this;
    }

    /**
     * Change any default option
     *
     * [Note: this method doesn't work if default options is json string format]
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
    private function applyDefaultOptions()
    {
        $options = $this->defaultOptions();

        if (is_array($options)) {
            // modify default options if found any
            if ( ! empty($this->modifyOptions)) {
                foreach ($this->modifyOptions as $key => $value) {
                    set_value_in_array_nested($options, $key, $value);
                }

                return $options;
            }
        }

        return $options;
    }

    /**
     * Default options
     *
     * [Note: Default options could be in php array format or raw json string format]
     *
     * @return array|string
     */
    protected function defaultOptions()
    {
        return GeneralOption::OPTIONS;
    }
}