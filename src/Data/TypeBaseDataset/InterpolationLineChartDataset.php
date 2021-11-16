<?php


namespace RadiateCode\DaChart\Data\TypeBaseDataset;


use RadiateCode\DaChart\Data\Dataset;

class InterpolationLineChartDataset extends Dataset
{
    /**
     * Generate dataset by these properties
     *
     * @param  string  $label
     * @param  array  $data
     * @param  string  $backgroundColor
     * @param  bool  $fill
     * @param  string  $cubicInterpolationMode
     * @param  string  $tension
     * @param  string|null  $borderColor
     *
     * @return Dataset
     */
    public function dataset(
        string $label,
        array $data,
        string $backgroundColor,
        bool $fill,
        string $cubicInterpolationMode,
        string $tension,
        string $borderColor = null
    ): Dataset {
        $this->label($label)
            ->backgroundColor($backgroundColor)
            ->data($data)
            ->fill($fill)
            ->cubicInterpolationMode($cubicInterpolationMode)
            ->tension($tension)
            ->when($borderColor, function ($action) use ($borderColor) {
                return $action->borderColor($borderColor);
            })->make();

        return $this;
    }
}