<?php


namespace DaCode\DaChart\Types\Line;


use DaCode\DaChart\Abstracts\BaseChartType;
use DaCode\DaChart\Enums\ChartType;
use DaCode\DaChart\Facades\OptionBuilder as Builder;
use DaCode\DaChart\Options\Interaction;
use DaCode\DaChart\Options\Legend;
use DaCode\DaChart\Options\Responsive;
use DaCode\DaChart\Options\Title;

class SteppedLineChart extends BaseChartType
{
    public function type(): string
    {
        return ChartType::LINE_CHART;
    }

    protected function defaultOptions(): array
    {
        return Builder::option(Responsive::class)
            ->option(Interaction::class)
            ->option(Legend::class)
            ->option(Title::class)
            ->render();
    }
}