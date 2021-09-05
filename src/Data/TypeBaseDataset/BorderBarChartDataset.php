<?php


namespace RadiateCode\DaChart\Data\TypeBaseDataset;


use RadiateCode\DaChart\Data\Dataset;

class BorderBarChartDataset extends Dataset
{
    private $datasets = [];

    /**
     * Generate dataset by these properties
     *
     * @param  string       $label
     * @param  array        $data
     * @param  string       $backgroundColor
     * @param  int          $borderWith
     * @param  int          $borderRadius
     * @param  bool         $borderSkipped
     * @param  string|null  $borderColor
     *
     * @return Dataset
     */
    public function barChartDataset(string $label, array $data,
        string $backgroundColor, int $borderWith, int $borderRadius,
        bool $borderSkipped, string $borderColor = null
    ): Dataset {
        $this->datasets[] = $this->label($label)
            ->backgroundColor($backgroundColor)
            ->data($data)
            ->borderWidth($borderWith)
            ->borderRadius($borderRadius)
            ->borderSkipped($borderSkipped)
            ->when($borderColor, function ($action) use ($borderColor) {
                return $action->borderColor($borderColor);
            })->make();

        return $this;
    }

    /**
     * @return array
     */
    public function render(): array
    {
        return $this->datasets;
    }
}