<?php


namespace RadiateCode\DaChart;

use RadiateCode\DaChart\Contracts\ChartInterface;
use RadiateCode\DaChart\Contracts\TypeInterface;
use RadiateCode\DaChart\Facades\HtmlBuilder;
use RadiateCode\DaChart\Types\Bar\HorizontalBarChart;
use Illuminate\Support\Str;
use \InvalidArgumentException;

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
     * Pass datasets array.
     *
     * [Note: datasets can build by DatasetBuilder or you can pass custom array]
     *
     * @param array $datasets
     *
     * @return $this
     */
    public function datasets(array $datasets): Chart
    {
        $this->datasets = $datasets;

        return $this;
    }

    /**
     * Helpful to set custom options if caller don't want to use the default chart options
     *
     * @param  array  $options
     *
     * @return $this
     */
    public function options(array $options): Chart
    {
        $this->chartType->customOptions($options);

        return $this;
    }

    /**
     * This one might be helpful to change the value of any "default" option
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
            ->labels($this->labels)
            ->datasets($this->datasets)
            ->options($this->chartType->options())
            ->render();
    }

    /**
     * Resolve html builder to generate html, script, js library for chart
     *
     * @return HtmlBuilder|mixed
     */
    public function template()
    {
        return HtmlBuilder::resolve($this);
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