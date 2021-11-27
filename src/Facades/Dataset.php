<?php


namespace RadiateCode\DaChart\Facades;


use Illuminate\Support\Facades\Facade;
use RadiateCode\DaChart\Contracts\DatasetInterface;

/**
 * @method static DatasetInterface label(string $label)
 * @method static DatasetInterface stack(string $stack)
 * @method static DatasetInterface stepped(string $stepped)
 * @method static DatasetInterface type(string $type)
 * @method static DatasetInterface tension(string $tension)
 * @method static DatasetInterface hoverOffset(string $hoverOffset)
 * @method static DatasetInterface cubicInterpolationMode(string $mode)
 * @method static DatasetInterface xAxisID(string $xAxisID)
 * @method static DatasetInterface yAxisID(string $yAxisID)
 * @method static DatasetInterface order(string $order)
 * @method static DatasetInterface hidden(string $hidden)
 * @method static DatasetInterface pointStyle(string $pointStyle)
 * @method static DatasetInterface borderJoinStyle(string $borderJoinStyle)
 * @method static DatasetInterface borderAlign(string $borderAlign)
 * @method static DatasetInterface rotation($rotation)
 * @method static DatasetInterface spacing($spacing)
 * @method static DatasetInterface weight($weight)
 * @method static DatasetInterface circumference($circumference)
 * @method static DatasetInterface borderWidth($width)
 * @method static DatasetInterface borderRadius($radius)
 * @method static DatasetInterface pointRadius($radius)
 * @method static DatasetInterface barPercentage($percentage)
 * @method static DatasetInterface barThickness($thickness)
 * @method static DatasetInterface maxBarThickness($thickness)
 * @method static DatasetInterface minBarLength($length)
 * @method static DatasetInterface hoverBorderWidth($width)
 * @method static DatasetInterface hoverBorderRadius($radius)
 * @method static DatasetInterface pointHoverBorderWidth($width)
 * @method static DatasetInterface pointHitRadius($radius)
 * @method static DatasetInterface pointHoverRadius($radius)
 * @method static DatasetInterface borderDashOffset($offset)
 * @method static DatasetInterface offset(float $offset)
 * @method static DatasetInterface skipNull(bool $borderSkipped)
 * @method static DatasetInterface borderSkipped(bool $borderSkipped)
 * @method static DatasetInterface fill(bool $fill)
 * @method static DatasetInterface data(array $data)
 * @method static DatasetInterface segment(array $data)
 * @method static DatasetInterface backgroundColor($color)
 * @method static DatasetInterface borderColor($color)
 * @method static DatasetInterface pointBackgroundColor($color)
 * @method static DatasetInterface pointBorderColor($color)
 * @method static DatasetInterface pointHoverBackgroundColor($color)
 * @method static DatasetInterface pointHoverBorderColor($color)
 * @method static DatasetInterface general(string $label, array $data, $backgroundColor = null, $boarderColor = null)
 * @method static array make()
 *
 * @see DatasetInterface
 * @see \RadiateCode\DaChart\Data\Dataset
 */
class Dataset extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'dataset.builder';
    }
}