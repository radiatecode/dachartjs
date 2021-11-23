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
            ->addProperty('cubicInterpolationMode', 'string')
            ->addProperty('indexAxis', 'string')
            ->addProperty('xAxisID', 'string')
            ->addProperty('yAxisID', 'string')
            ->addProperty('hidden', 'string')
            ->addProperty('pointStyle', 'string')
            ->addProperty('borderJoinStyle', 'string')
            ->addProperty('borderAlign', 'string')
            ->addProperty('order', 'float','integer')
            ->addProperty('rotation', 'float','integer')
            ->addProperty('spacing', 'float','integer')
            ->addProperty('weight', 'float','integer')
            ->addProperty('circumference', 'float','integer')
            ->addProperty('borderWidth', 'float','integer')
            ->addProperty('borderWidth', 'float','integer')
            ->addProperty('borderRadius', 'float','integer')
            ->addProperty('pointRadius', 'float','integer')
            ->addProperty('pointRotation', 'float','integer')
            ->addProperty('barPercentage', 'float','integer')
            ->addProperty('barThickness', 'float','integer')
            ->addProperty('maxBarThickness', 'float','integer')
            ->addProperty('minBarLength', 'float','integer')
            ->addProperty('hoverBorderWidth', 'float','integer')
            ->addProperty('hoverBorderRadius', 'float','integer')
            ->addProperty('pointHitRadius', 'float','integer')
            ->addProperty('pointHoverBorderWidth', 'float','integer')
            ->addProperty('pointHoverRadius', 'float','integer')
            ->addProperty('borderDashOffset', 'float','integer')
            ->addProperty('offset', 'float','integer')
            ->addProperty('skipNull', 'boolean')
            ->addProperty('borderSkipped', 'boolean')
            ->addProperty('fill', 'boolean')
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