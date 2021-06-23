<?php


namespace DaCode\DaChart\Types\Line;


use DaCode\DaChart\Abstracts\BaseChartType;
use DaCode\DaChart\Enums\ChartType;
use DaCode\DaChart\Facades\OptionBuilder as Builder;
use DaCode\DaChart\Options\Interaction;
use DaCode\DaChart\Options\Responsive;
use DaCode\DaChart\Options\Scales;
use DaCode\DaChart\Options\Stacked;
use DaCode\DaChart\Options\Title;

class MultiAxisLineChart extends BaseChartType
{
    public function type(): string
    {
        return ChartType::LINE_CHART;
    }

    protected function defaultOptions(): array
    {
        return Builder::option(Responsive::class)
            ->option(Interaction::class,['mode'=>'index','intersect'=>false])
            ->option(Stacked::class)
            ->option(Title::class)
            ->option(Scales::class,[
                'y' => [
                    'type' => 'linear',
                    'display' => true,
                    'position' => 'left',
                ],
                'y1' => [
                    'type' => 'linear',
                    'display' => true,
                    'position' => 'right',
                    // grid line settings
                    'grid' => [
                        'drawOnChartArea' => false, // only want the grid lines for one axis to show up
                    ],
                ],
            ])->render();
    }
}