<?php


namespace RadiateCode\DaChart\Data\TypeBaseDataset;


use RadiateCode\DaChart\Data\DatasetBuilder;

class InterpolationLineChartDataset extends DatasetBuilder
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
     * @return DatasetBuilder
     */
    public function interpolationDataset(
        string $label,
        array $data,
        string $backgroundColor,
        bool $fill,
        string $cubicInterpolationMode,
        string $tension,
        string $borderColor = null
    ): DatasetBuilder {
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