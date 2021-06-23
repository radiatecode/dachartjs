<?php


namespace DaCode\DaChart\Data;


use BadMethodCallException;
use Illuminate\Support\Arr;
use Illuminate\Support\Traits\Conditionable;

class Dataset
{
    use Conditionable;

    private $callableMethods = [];

    private $dataset = [];

    private $properties = [
        'label' => ['type' => 'string','callable' => 1],
        'stack' => ['type' => 'string','callable' => 1],
        'borderWith' => ['type' => 'number','callable' => 1],
        'borderRadius' => ['type' => 'number','callable' => 1],
        'borderSkipped' => ['type' => 'bool','callable' => 1],
        'fill' => ['type' => 'bool','callable' => 1],
        'stepped' => ['type' => 'string','callable' => 1],
        'type' => ['type' => 'string','callable' => 1],
        'tension' => ['type' => 'string','callable' => 1],
        'hoverOffset' => ['type' => 'string','callable' => 1],
        'rotation' => ['type' => 'string','callable' => 1],
        'cubicInterpolationMode' => ['type' => 'string','callable' => 1],
        'xAxisID' => ['type' => 'string','callable' => 1],
        'yAxisID' => ['type' => 'string','callable' => 1],
        'order' => ['type' => 'string','callable' => 1],
        'hidden' => ['type' => 'string','callable' => 1],
        'pointStyle' => ['type' => 'string','callable' => 1],
        'pointRadius' => ['type' => 'number','callable' => 1],
        'backgroundColor' => ['type' => 'array','callable' => 1],
        'borderColor' => ['type' => 'array','callable' => 1],
        'pointBackgroundColor' => ['type' => 'array','callable' => 1],
        'pointBorderColor' => ['type' => 'array','callable' => 1],
        'pointHoverBackgroundColor' => ['type' => 'array','callable' => 1],
        'pointHoverBorderColor' => ['type' => 'array','callable' => 1],
        'data' => ['type' => 'array','callable' => 1],
        'segment' => ['type' => 'array','callable' => 1],
    ];

    /**
     * It will use when a dataset need to make by all callable methods
     *
     * @return $this
     */
    public function make(): Dataset
    {
        if (!empty($this->callableMethods)) {
            $this->dataset[] = $this->callableMethods;
        }

        $this->callableMethods = []; // reset after making a dataset

        return $this;
    }

    /**
     * Generate dataset by most common properties
     *
     * @return $this
     */
    public function dataset(string $label,array $data,string $backgroundColor,string $borderColor = null): Dataset
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
        return $this->dataset;
    }

    /**
     * More properties can be added
     *
     * @param  string  $name
     * @param  string  $type
     * @param  bool    $isCallable
     *
     * @return $this
     */
    protected function pushProperty(string $name,string $type,bool $isCallable): Dataset
    {
        $this->properties[$name] = ['type'=>$type,'callable'=>$isCallable];

        return $this;
    }

    /**
     * This will allow to call a method by the exact same name which are listed in properties array
     * [It creates callable methods dynamically]
     *
     * @param $method
     * @param $parameters
     *
     * @return $this
     *
     * @throws BadMethodCallException
     */
    public function __call($method, $parameters)
    {
        if (Arr::has($this->properties,$method)){
            $this->callableMethods[$method] = $parameters[0];

            return $this;
        }

        throw new BadMethodCallException("Method {$method} does not exist.");
    }
}