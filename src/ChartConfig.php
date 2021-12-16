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

    /**
     * @return array
     */
    protected function extractPlugins(): array
    {
        if (empty($this->plugins)) {
            return [];
        }

        $libraries = "";
        $options   = [];
        $ids       = [];

        foreach ($this->plugins as $name => $value) {
            $plugin = null;

            if (is_numeric($name)){
                $plugin = new $value();

                $options[] = $this->pluginOptions($plugin->options());
            }else{
                $plugin = new $name();

                $options[] = $this->pluginOptions($value);
            }

            $libraries .= $plugin->libraries();

            if (! empty($plugin->id())){
                $ids[]     = $plugin->id();
            }
        }

        return [
            'libraries' => $libraries,
            'options'   => implode(",",$options),
            'ids'       => json_encode($ids),
        ];
    }

    protected function pluginOptions($options){
        if (empty($options)){
            return "";
        }

        if (is_array($options)){
            return json_encode($options);
        }

        return $options;
    }
}