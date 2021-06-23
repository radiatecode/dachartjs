<?php


namespace DaCode\DaChart\Types\Line;


use DaCode\DaChart\Abstracts\BaseChartType;
use DaCode\DaChart\Enums\ChartType;
use DaCode\DaChart\Facades\OptionBuilder as Builder;
use DaCode\DaChart\Options\Interaction;
use DaCode\DaChart\Options\Responsive;
use DaCode\DaChart\Options\Scales;
use DaCode\DaChart\Options\Title;

class InterpolationLineChart extends BaseChartType
{
    public function type(): string
    {
        return ChartType::LINE_CHART;
    }

    protected function defaultOptions(): array
    {
        return Builder::option(Responsive::class)
            ->option(Interaction::class,['mode'=>'index','intersect'=>false])
            ->option(Title::class)
            ->option(Scales::class,[
                'x' => [
                    'display' => true,
                    'title' => [
                        'display' => true,
                        'text' => 'X axis value'
                    ],
                ],
                'y' => [
                    'display' => true,
                    'title' => [
                        'display' => true,
                        'text' => 'Y axis value'
                    ],
                ],
                'suggestedMin' => -10,
                'suggestedMax'=> 200
            ])->render();
    }

}