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
 * @method static DatasetInterface rotation(string $rotation)
 * @method static DatasetInterface cubicInterpolationMode(string $mode)
 * @method static DatasetInterface xAxisID(string $xAxisID)
 * @method static DatasetInterface yAxisID(string $yAxisID)
 * @method static DatasetInterface order(string $order)
 * @method static DatasetInterface hidden(string $hidden)
 * @method static DatasetInterface pointStyle(string $pointStyle)
 * @method static DatasetInterface borderWidth(int $width)
 * @method static DatasetInterface borderRadius(int $radius)
 * @method static DatasetInterface pointRadius(int $radius)
 * @method static DatasetInterface borderSkipped(bool $borderSkipped)
 * @method static DatasetInterface fill(bool $fill)
 * @method static DatasetInterface data(array $data)
 * @method static DatasetInterface segment(array $data)
 * @method static DatasetInterface backgroundColor($color)
 * @method static DatasetInterface borderColor($color)
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