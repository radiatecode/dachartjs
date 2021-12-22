<?php


namespace RadiateCode\DaChartjs\Facades;


use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Facade;

/**
 * @method static \RadiateCode\DaChartjs\Response\ChartResponse labels(array $labels)
 * @method static \RadiateCode\DaChartjs\Response\ChartResponse datasets(array $datasets)
 * @method static JsonResponse toJson()
 * @method static array toArray()
 *
 * @see \RadiateCode\DaChartjs\Response\ChartResponse
 */
class ChartResponse extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'chart.response';
    }
}