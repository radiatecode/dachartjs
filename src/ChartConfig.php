<?php


namespace RadiateCode\DaChart;

class ChartConfig
{
    private $chartName = null;

    private $type = null;

    private $options = [];

    private $labels = [];

    private $datasets = [];

    /**
     * @param  string  $chartName
     *
     * @return ChartConfig
     */
    public function chartName(string $chartName): ChartConfig
    {
        $this->chartName = $chartName;

        return $this;
    }

    /**
     * @param  null  $type
     */
    public function type($type): ChartConfig
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @param  array  $options
     *
     * @return $this
     */
    public function options(array $options): ChartConfig
    {
        $this->options = $options;

        return $this;
    }

    /**
     * @param  array  $labels
     *
     * @return $this
     */
    public function labels(array $labels): ChartConfig
    {
        $this->labels = $labels;

        return $this;
    }

    /**
     * @param  array  $datasets
     *
     * @return $this
     */
    public function datasets(array $datasets): ChartConfig
    {
        $this->datasets = $datasets;

        return $this;
    }

    /**
     * Render chart config | [this will be used as config or setup for frond-end chart js library]
     *
     * @return array
     */
    public function render(): array
    {
        return [
            'chart_name' => $this->chartName,
            'type' => $this->type,
            'data' => [
                'labels'=> $this->labels,
                'datasets' => $this->datasets
            ],
            'options' => $this->options
        ];
    }
}