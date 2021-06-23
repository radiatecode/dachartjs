<?php


namespace DaCode\DaChart\Facades;


use Illuminate\Support\Facades\Facade;

/**
 * Class Dataset
 * @method static mixed|\DaCode\DaChart\Data\DatasetBuilder dataset(string $label,array $data,string $backgroundColor,string $borderColor = null)
 * @method static mixed|\DaCode\DaChart\Data\DatasetBuilder make()
 * @method static mixed|array render()
 *
 * @see \DaCode\DaChart\Data\Dataset
 */
class Dataset extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'dataset.builder';
    }
}