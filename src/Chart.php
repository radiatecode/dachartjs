<?php


namespace RadiateCode\DaChart;

use RadiateCode\DaChart\Contracts\ChartInterface;
use RadiateCode\DaChart\Contracts\TypeInterface;
use RadiateCode\DaChart\Data\Data;
use RadiateCode\DaChart\Data\DatasetBuilder;
use RadiateCode\DaChart\Facades\ChartBuilder as Builder;
use RadiateCode\DaChart\Types\Bar\HorizontalBarChart;
use Illuminate\Support\Str;
use \InvalidArgumentException;
use TypeError;

class Chart implements ChartInterface
{
    /**
     * @var TypeInterface $chartType
     */
    private $chartType;

    /**
     * @var $chartName
     */
    private $chartName;

    /**
     * @var array $datasets
     */
    private $datasets = [];

    /**
     * @var array $labels
     */
    private $labels = [];


    /**
     * Chart constructor.
     *
     * @param  string  $title
     *
     * @param  string  $type // $type should be a class path [ex: HorizontalBarChart::class]
     */
    public function __construct(string $title,string $type)
    {
        $this->chartName($title);

        /**
         * Resolve the chart type class
         */
        $this->resolveType($type);

        /*
         * change the default title text
         *
         * [ side note: every dot key used to access the nested array keys]
         */
        $this->changeDefaultOption('plugins.title.text',$title);
    }

    /**
     * Set chat labels
     *
     * @param  array  $labels
     *
     * @return $this
     */
    public function labels(array $labels): Chart
    {
        $this->labels = $labels;

        return $this;
    }

    /**
     * Pass a callback function with dataset.
     *
     *
     * @param $callback
     *
     * @return $this
     */
    public function data($callback): Chart
    {
        if ( ! is_callable($callback)) {
            throw new TypeError('Argument should be a callback function!');
        }

        $call = call_user_func($callback,new DatasetBuilder());

        if ($call instanceof DatasetBuilder) {
           $this->datasets = $call->render();

            return $this;
        }

        if (is_array($call)) {
            $this->datasets = $call;

            return $this;
        }

        throw new InvalidArgumentException(
            'Callback function should be return a object of dataset or an array!'
        );
    }

    /**
     * Render data
     *
     * @return array
     */
    private function renderData(): array
    {
        return (new Data())
            ->labels($this->labels)
            ->datasets($this->datasets)
            ->render();
    }

    /**
     * Helpful to set custom options if caller don't want to use the default chart options
     *
     * @param $callback
     *
     * @return $this
     */
    public function options($callback): Chart
    {
        $this->chartType->customOptions($callback);

        return $this;
    }

    /**
     * This one might be helpful to change or modify the value of any "default" option
     *
     * @param  string  $key
     * @param  string  $value
     *
     * @return $this
     */
    public function changeDefaultOption(string $key,string $value): Chart
    {
        $this->chartType->changeDefaultOption($key,$value);

        return $this;
    }

    /**
     * Render the chart configuration
     *
     * @return array
     */
    public function render(): array
    {
        return (new ChartConfig())
            ->chartName($this->chartName)
            ->type($this->chartType->type())
            ->data($this->renderData())
            ->options($this->chartType->options())
            ->render();
    }

    /**
     * Resolve chart builder to generate html, script, js library for chart
     *
     * @return ChartBuilder|mixed
     */
    public function template()
    {
        return Builder::resolve($this);
    }

    /**
     * Set chart name
     *
     * @param  string  $name
     *
     * @return void
     */
    private function chartName(string $name): void
    {
        $this->chartName = Str::slug($name, '_');
    }

    /**
     * @return string
     */
    public function getChartName(): string
    {
        return $this->chartName;
    }

    /**
     * Resolve chart type
     *
     * @param $chart
     *
     * @return void
     */
    private function resolveType($chart): void
    {
        if (! class_exists($chart)){
            throw new InvalidArgumentException('Argument 2 must be a class path!');
        }

        $chartType = new $chart();

        if (! $chartType instanceof TypeInterface){
            throw new InvalidArgumentException('Argument 2 must be a class of TypeInterface!');
        }

        $this->chartType = $chartType;
    }
}