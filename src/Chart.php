<?php


namespace RadiateCode\DaChartjs;

use RadiateCode\DaChartjs\Contracts\TypeInterface;
use RadiateCode\DaChartjs\Html\Builder;
use RadiateCode\DaChartjs\Types\Bar\HorizontalBarChart;
use \InvalidArgumentException;

class Chart
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

    private $size = [];

    /**
     * Chart constructor.
     *
     * @param  string  $title
     *
     * @param  string  $type  // $type should be a class path [ex: HorizontalBarChart::class]
     */
    public function __construct(string $title, string $type)
    {
        $this->chartName($title);

        /**
         * Resolve the chart type class
         */
        $this->resolveType($type);

        /*
         * Change the default title text
         */
        $this->changeDefaultOption('plugins.title.text', $title);
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
     * Chart size
     *
     * @param  int  $height
     * @param  int|null  $width // width is optional. If we want responsive chart
     *
     * @return $this
     */
    public function size(int $height, int $width = null): Chart
    {
        $this->size = [
            'height' => $height,
            'width' => $width
        ];

        if (isset($width)){ // if width is set then responsive option is false
            $this->changeDefaultOption('responsive', false);
        }

        return $this;
    }

    /**
     * Pass datasets array.
     *
     * [Note: datasets can build by DatasetBuilder or you can pass custom array]
     *
     * @param  array  $datasets
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
     * [Note: options could be php array format or raw json string format]
     *
     * @param   $options
     *
     * @return $this
     */
    public function options($options): Chart
    {
        $this->chartType->customOptions($options);

        return $this;
    }

    /**
     * This one might be helpful to change the value of any "default" option
     *
     * [ side note: key param accept dot notation to access the nested array keys]
     *
     * @param  string  $key
     * @param  string  $value
     *
     * @return $this
     */
    public function changeDefaultOption(string $key, string $value): Chart
    {
        $this->chartType->changeDefaultOption($key, $value);

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
     * @return Builder
     */
    public function template(): Builder
    {
        return new Builder($this->chartName,$this->render(),$this->size);
    }

    /**
     * Set chart name
     *
     * @param  string  $name
     *
     * @return void
     */
    private function chartName(string $name)
    {
        $this->chartName = slugify($name, '_');
    }

    /**
     * Resolve chart type
     *
     * @param $chart
     *
     * @return void
     */
    private function resolveType($chart)
    {
        if ( ! class_exists($chart)) {
            throw new InvalidArgumentException('Argument 2 must be a class path!');
        }

        $chartType = new $chart();

        if ( ! $chartType instanceof TypeInterface) {
            throw new InvalidArgumentException('Argument 2 must be a concrete class of TypeInterface!');
        }

        $this->chartType = $chartType;
    }
}