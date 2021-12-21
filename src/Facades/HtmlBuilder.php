<?php


namespace RadiateCode\DaChart\Facades;

use RadiateCode\DaChart\Contracts\ChartInterface;
use Illuminate\Support\Facades\Facade;
use Illuminate\Support\HtmlString;
use RadiateCode\DaChart\Html\Builder;

/**
 * @method static mixed|Builder resolve(ChartInterface $chart))
 * @method static mixed|HtmlString chartHtml()
 * @method static mixed|HtmlString chartScript()
 * @method static mixed|HtmlString apiChartScript()
 * @method static mixed|string chartLibraries()
 * @method static mixed|string template()
 *
 * @see Builder
 */
class HtmlBuilder extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'html.builder';
    }
}
