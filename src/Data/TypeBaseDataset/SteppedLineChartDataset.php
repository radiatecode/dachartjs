<?php


namespace DaCode\DaChart\Data\TypeBaseDataset;


use DaCode\DaChart\Data\Dataset;

class SteppedLineChartDataset extends Dataset
{
    /**
     * Generate dataset by these properties
     *
     * @return $this
     */
    public function steppedDataset(string $label,array $data,string $backgroundColor,bool $fill,bool $stepped, string $borderColor = null): Dataset
    {
        $this->label($label)
            ->backgroundColor($backgroundColor)
            ->data($data)
            ->fill($fill)
            ->stepped($stepped)
            ->when($borderColor,function ($action) use ($borderColor){
                return $action->borderColor($borderColor);
            })->make();

        return $this;
    }
}