<?php


namespace DaCode\DaChart\Types\Bar;

use DaCode\DaChart\Abstracts\BaseChartType;
use DaCode\DaChart\Enums\ChartType;
use DaCode\DaChart\Facades\OptionBuilder as Builder;
use DaCode\DaChart\Options\Legend;
use DaCode\DaChart\Options\Responsive;
use DaCode\DaChart\Options\Scales;
use DaCode\DaChart\Options\Title;

class StackedBarChart extends BaseChartType
{
    public function type(): string
    {
        return ChartType::BAR_CHART;
    }

    protected function defaultOptions(): array
    {
        return Builder::option(Responsive::class)
            ->option(Legend::class)
            ->option(Title::class)
            ->option(Scales::class)
            ->render();
    }
}