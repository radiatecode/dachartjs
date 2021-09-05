<?php


namespace RadiateCode\DaChart\Abstracts;

use RadiateCode\DaChart\Chart;

abstract class AbstractChart
{
    /**
     * Chart title
     *
     * ---------------------------------------------------------------------
     * Note: it can be use as chart id or chart name in js & html
     * ---------------------------------------------------------------------
     *
     * @return string
     */
    abstract protected function chartTitle(): string;

    /**
     * Chart type
     *
     * ---------------------------------------------------------------------
     * Note: Chart type must be concrete class of TypeInterface
     * ---------------------------------------------------------------------
     *
     * @return string
     */
    abstract protected function chartType(): string;

    /**
     * Chart labels
     * This labels are used to label the data index (default x axis) in the chart view
     *
     * -----------------------------------------------------------------------------------------------
     * Note: it is used as data property, and data of datasets need to be provided same amount of elements as this labels.
     * ------------------------------------------------------------------------------------------------
     *
     * @return array
     */
    abstract protected function labels(): array;

    /**
     * Dataset
     *
     * -------------------------------------------------------------------------------------------------
     * Note: datasets can build by Dataset Facade or you can pass custom array with dataset properties,
     * basic format
     *      [
     *          'label' => 'Label One',
     *          'data' => [20,30,40],
     *          'backgroundColor' => 'green'
     *          'borderColor' => 'red',
     *          'borderWidth' => 1
     *      ]
     * -------------------------------------------------------------------------------------------------
     *
     * @return array
     */
    abstract protected function datasets(): array;

    /**
     * Custom options
     *
     * ---------------------------------------------------------------------------------------------
     * Note: Each chart type class has default options, but if you don't want to use the default
     * then this methods can be useful to provide custom options
     * ---------------------------------------------------------------------------------------------
     *
     * @return array
     */
    public function options(): array
    {
        return [];
    }

    /**
     * Render the chart
     *
     * @return array
     */
    public function render(): array
    {
        return $this->chart()->render();
    }

    /**
     * Build the chart html & js scripts
     */
    public function template()
    {
        return $this->chart()->template();
    }

    /**
     * Config chart
     *
     * @return Chart
     */
    private function chart(): Chart
    {
        $chart = new Chart($this->chartTitle(), $this->chartType());

        if ( ! empty($this->options())) {
            $chart->options($this->options());
        }

        return $chart
            ->labels($this->labels())
            ->datasets($this->datasets());
    }
}