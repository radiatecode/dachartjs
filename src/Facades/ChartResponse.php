<?php


namespace RadiateCode\DaChart\Facades;


use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Facade;

/**
 * @method static \RadiateCode\DaChart\Response\ChartResponse labels(array $labels)
 * @method static \RadiateCode\DaChart\Response\ChartResponse datasets(array $datasets)
 * @method static JsonResponse toJson()
 * @method static array toArray()
 *
 * @see \RadiateCode\DaChart\Response\ChartResponse
 */
class ChartResponse extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'chart.response';
    }
}