<?php


namespace RadiateCode\DaChart\Data;


use RadiateCode\DaChart\Enums\ChartColor;
use RadiateCode\DaChart\Traits\CallableProperty;
use RadiateCode\DaChart\Traits\Conditionable;

class Dataset
{
    use Conditionable, CallableProperty;

    private $dataset = [];

    public function __construct()
    {
        /**
         * Dataset generate with several properties
         *
         * These properties can be call as a method and set it's value by the method args
         *
         */
        $this->addProperty('label', 'string')
            ->addProperty('stack', 'string')
            ->addProperty('stepped', 'string')
            ->addProperty('type', 'string')
            ->addProperty('tension', 'string')
            ->addProperty('hoverOffset', 'string')
            ->addProperty('rotation', 'string')
            ->addProperty('cubicInterpolationMode', 'string')
            ->addProperty('indexAxis', 'string')
            ->addProperty('xAxisID', 'string')
            ->addProperty('yAxisID', 'string')
            ->addProperty('order', 'string')
            ->addProperty('hidden', 'string')
            ->addProperty('pointStyle', 'string')
            ->addProperty('borderWidth', 'number')
            ->addProperty('borderRadius', 'number')
            ->addProperty('pointRadius', 'number')
            ->addProperty('barPercentage', 'number')
            ->addProperty('barThickness', 'number')
            ->addProperty('maxBarThickness', 'number')
            ->addProperty('minBarLength', 'number')
            ->addProperty('hoverBorderWidth', 'number')
            ->addProperty('hoverBorderRadius', 'number')
            ->addProperty('borderSkipped', 'bool')
            ->addProperty('fill', 'bool')
            ->addProperty('backgroundColor', 'array','string')
            ->addProperty('borderColor', 'array','string')
            ->addProperty('pointBackgroundColor', 'array','string')
            ->addProperty('pointBorderColor', 'array','string')
            ->addProperty('pointHoverBackgroundColor', 'array','string')
            ->addProperty('hoverBackgroundColor', 'array','string')
            ->addProperty('pointHoverBorderColor', 'array','string')
            ->addProperty('hoverBorderColor', 'array','string')
            ->addProperty('data', 'array')
            ->addProperty('segment', 'array');
    }

    /**
     * Make dataset by most used and common properties
     *
     * @param  string  $label
     * @param  array  $data
     * @param  null  $backgroundColor
     * @param  null  $boarderColor
     *
     * @return mixed
     */
    public function general(
        string $label,
        array $data,
        $backgroundColor = null,
        $boarderColor = null
    ) {
        if (empty($backgroundColor)){
            $randomColor = ChartColor::randColor();
            $backgroundColor = $randomColor;
            $boarderColor = $randomColor;
        }

        if (! empty($backgroundColor) && empty($boarderColor)){
            $boarderColor = $backgroundColor;
        }


        return $this->label($label)
            ->data($data)
            ->backgroundColor($backgroundColor)
            ->borderColor($boarderColor);
    }

    /**
     * This method will make single dataset array with callable properties/methods
     *
     * [note: this method need to be call after callable properties]
     *
     * @return array
     */
    public function make(): array
    {
        if ( ! empty($this->calls())) {
            $this->dataset = $this->calls();
        }

        $this->resetCallableMethods();

        return $this->dataset;
    }
}