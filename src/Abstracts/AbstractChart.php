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
     *
     * ---------------------------------------------------------------------------------
     * Note: This labels are used to label the data index (default x axis) in the chart view
     * ---------------------------------------------------------------------------------
     *
     * @return array
     */
    abstract protected function labels(): array;

    /**
     * Dataset
     *
     * -------------------------------------------------------------------------------------------------
     * Note: datasets can be generate by Dataset Facade Or we can pass custom array with dataset properties,
     * -------------------------------------------------------------------------------------------------
     *
     * @return array
     */
    abstract protected function datasets(): array;

    /**
     * change default options
     *
     * ---------------------------------------------------------------------------------------------
     * Note: Each type of chart has default options, we can use this method
     * when we need to modify those default options
     * ---------------------------------------------------------------------------------------------
     *
     * @return array
     */
    protected function changeDefaultOptions(): array
    {
        return [];
    }

    /**
     * Custom options
     *
     * ---------------------------------------------------------------------------------------------
     * Note: If we don't want to use the default, then this methods can be useful for custom options
     * ---------------------------------------------------------------------------------------------
     *
     * @return array|string
     */
    protected function options()
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
     * chart Config
     *
     * @return Chart
     */
    private function chart(): Chart
    {
        $chart = new Chart($this->chartTitle(), $this->chartType());

        $optionModifications = $this->changeDefaultOptions();

        if ( ! empty($this->options())) {
            $chart->options($this->options());
        }

        if ( ! empty($optionModifications)) {
            foreach ($optionModifications as $key => $value) {
                $chart->changeDefaultOption($key, $value);
            }
        }

        return $chart
            ->labels($this->labels())
            ->datasets($this->datasets());
    }
}