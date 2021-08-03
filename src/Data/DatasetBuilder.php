<?php


namespace DaCode\DaChart\Data;


use BadMethodCallException;
use DaCode\DaChart\Traits\CallableProperty;
use Illuminate\Support\Arr;
use Illuminate\Support\Traits\Conditionable;

class DatasetBuilder
{
    use Conditionable, CallableProperty;

    /**
     * Datasets
     *
     * @var array $datasets
     */
    private $datasets = [];


    public function __construct()
    {
        /**
         * Dataset generate with several properties
         *
         * These properties can be call as a method and set it's value by the method args
         *
         */
        $this->addProperty('label','string')
            ->addProperty('stack','string')
            ->addProperty('stepped','string')
            ->addProperty('type','string')
            ->addProperty('tension','string')
            ->addProperty('hoverOffset','string')
            ->addProperty('rotation','string')
            ->addProperty('cubicInterpolationMode','string')
            ->addProperty('xAxisID','string')
            ->addProperty('yAxisID','string')
            ->addProperty('order','string')
            ->addProperty('hidden','string')
            ->addProperty('pointStyle','string')
            ->addProperty('borderWith','number')
            ->addProperty('borderRadius','number')
            ->addProperty('pointRadius','number')
            ->addProperty('borderSkipped','bool')
            ->addProperty('fill','bool')
            ->addProperty('backgroundColor','array')
            ->addProperty('borderColor','array')
            ->addProperty('pointBackgroundColor','array')
            ->addProperty('pointBorderColor','array')
            ->addProperty('pointHoverBackgroundColor','array')
            ->addProperty('pointHoverBorderColor','array')
            ->addProperty('data','array')
            ->addProperty('segment','array');
    }

    /**
     * This method will make single dataset array with callable properties/methods
     *
     * [note: this method need to be call after callable properties]
     *
     * @return $this
     */
    public function make(): DatasetBuilder
    {
        if (!empty($this->calls())) {
            $this->datasets[] = $this->calls();
        }

        $this->resetCallableMethods();

        return $this;
    }

    /**
     * Generate dataset by most common properties
     *
     * @return $this
     */
    public function dataset(string $label,array $data,string $backgroundColor,string $borderColor = null): DatasetBuilder
    {
        $this->label($label)
            ->backgroundColor($backgroundColor)
            ->data($data)
            ->when($borderColor,function ($action) use ($borderColor){
                return $action->borderColor($borderColor);
            })->make();

        return $this;
    }

    /**
     * Get all the datasets
     *
     * @return array
     */
    public function render(): array
    {
        return $this->datasets;
    }
}