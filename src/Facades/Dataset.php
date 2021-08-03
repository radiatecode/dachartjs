<?php


namespace RadiateCode\DaChart\Facades;


use Illuminate\Support\Facades\Facade;

/**
 * Class Dataset
 * @method static mixed|\RadiateCode\DaChart\Data\DatasetBuilder dataset(string $label,array $data,string $backgroundColor,string $borderColor = null)
 * @method static mixed|\RadiateCode\DaChart\Data\DatasetBuilder make()
 * @method static mixed|array render()
 *
 * @see \RadiateCode\DaChart\Data\Dataset
 */
class Dataset extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'dataset.builder';
    }
}