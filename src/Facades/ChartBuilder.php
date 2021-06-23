<?php


namespace DaCode\DaChart\Facades;

use DaCode\DaChart\Contracts\ChartInterface;
use Illuminate\Support\Facades\Facade;
use Illuminate\Support\HtmlString;

/**
 * @method static mixed|\DaCode\DaChart\ChartBuilder resolve(ChartInterface $chart))
 * @method static mixed|HtmlString chartHtml()
 * @method static mixed|HtmlString chartScripts()
 * @method static mixed|string chartLibrary()
 * @method static mixed|string template()
 *
 * @see ChartBuilder
 */
class ChartBuilder extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'chart.builder';
    }
}
