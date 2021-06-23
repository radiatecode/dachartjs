<?php


namespace DaCode\DaChart\Facades;


use Illuminate\Support\Facades\Facade;

/**
 * @method static mixed|\DaCode\DaChart\OptionBuilder option(string $class,array $params = [])
 * @method static mixed|array render()
 *
 * @see OptionBuilder
 *
 * @package DaCode\DaChart\Facades
 */
class OptionBuilder extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'option.builder';
    }
}