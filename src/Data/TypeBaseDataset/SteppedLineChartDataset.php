<?php


namespace RadiateCode\DaChart\Data\TypeBaseDataset;


use RadiateCode\DaChart\Data\Dataset;

class SteppedLineChartDataset extends Dataset
{
    private $datasets = [];

    /**
     * Generate dataset by these properties
     *
     * @return $this
     */
    public function steppedDataset(string $label,array $data,string $backgroundColor,bool $fill,bool $stepped, string $borderColor = null): Dataset
    {
        $this->datasets[] = $this->label($label)
            ->backgroundColor($backgroundColor)
            ->data($data)
            ->fill($fill)
            ->stepped($stepped)
            ->when($borderColor,function ($action) use ($borderColor){
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