<?php


namespace RadiateCode\DaChart\Types\Line;


use RadiateCode\DaChart\Abstracts\BaseChartType;
use RadiateCode\DaChart\Enums\ChartType;
use RadiateCode\DaChart\Options\General;

class SteppedLineChart extends BaseChartType
{
    public function type(): string
    {
        return ChartType::LINE_CHART;
    }

    /**
     * ------------------------------------
     * Override the base default options
     * -------------------------------------
     *
     * @return array
     */
    protected function defaultOptions(): array
    {
        return array_merge(General::OPTIONS, [
            'interaction' => [
                'intersect' => false,
                'mode'      => 'point',
                'axis'      => 'x',
            ],
        ]);
    }
}