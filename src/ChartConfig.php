<?php


namespace RadiateCode\DaChart;

class ChartConfig
{
    private $chartName = null;

    private $type = null;

    private $options = null;

    private $labels = [];

    private $datasets = [];

    private $plugins = [];

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
     * @param   $options
     *
     * @return $this
     */
    public function options($options): ChartConfig
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

    public function plugins(array $plugins): ChartConfig
    {
        $this->plugins = $plugins;

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
                'labels' => $this->labels,
                'datasets' => $this->datasets
            ],
            'options' => $this->options,
            'inject_plugins' => $this->extractPlugins()
        ];
    }

    protected function extractPlugins(): array
    {
        if (empty($this->plugins)) {
            return [];
        }

        $libraries = "";
        $options   = [];
        $ids       = [];

        foreach ($this->plugins as $plugin) {
            $obj = new $plugin();

            $libraries .= $obj->libraries();

            if (! empty($obj->id())){
                $ids[]     = $obj->id();
            }

            if (! empty($obj->options()) && is_array($obj->options())){
                $options[] = json_encode($obj->options());

                continue;
            }

            if (! empty($obj->options()) && is_string($obj->options())){
                $options[] = $obj->options();
            }
        }

        return [
            'libraries' => $libraries,
            'options'   => implode(",",$options),
            'ids'       => json_encode($ids),
        ];
    }
}