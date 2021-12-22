<?php


namespace RadiateCode\DaChartjs\Facades;

use RadiateCode\DaChartjs\Contracts\ChartInterface;
use Illuminate\Support\Facades\Facade;
use Illuminate\Support\HtmlString;
use RadiateCode\DaChartjs\Html\Builder;

/**
 * @method static mixed|Builder resolve(ChartInterface $chart))
 * @method static mixed|HtmlString chartHtml()
 * @method static mixed|HtmlString chartScripts()
 * @method static mixed|HtmlString apiChartScripts()
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
