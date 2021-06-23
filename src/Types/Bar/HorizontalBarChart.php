<?php


namespace DaCode\DaChart\Types\Bar;


use DaCode\DaChart\Abstracts\BaseChartType;
use DaCode\DaChart\Contracts\TypeInterface;
use DaCode\DaChart\Enums\ChartType;
use DaCode\DaChart\Facades\OptionBuilder as Builder;
use DaCode\DaChart\OptionBuilder;
use DaCode\DaChart\Options\Elements;
use DaCode\DaChart\Options\IndexAxis;
use DaCode\DaChart\Options\Legend;
use DaCode\DaChart\Options\Responsive;
use DaCode\DaChart\Options\Title;

class HorizontalBarChart extends BaseChartType
{
    public function type(): string
    {
        return ChartType::BAR_CHART;
    }

    protected function defaultOptions(): array
    {
       return Builder::option(IndexAxis::class)
        ->option(Elements::class)
        ->option(Responsive::class)
        ->option(Legend::class)
        ->option(Title::class)
        ->render();
    }
}