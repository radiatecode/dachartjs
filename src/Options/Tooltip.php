<?php


namespace DaCode\DaChart\Options;


use DaCode\DaChart\Abstracts\BaseOption;
use DaCode\DaChart\Contracts\Plugin;

class Tooltip extends BaseOption implements Plugin
{
    protected function default(): BaseOption
    {
        return $this->set('mode','index')
            ->set('intersect',true)
            ->set('position','nearest')
            ->set('backgroundColor','rgba(0, 0, 0, 0.8)')
            ->set('titleAlign','left');
    }

}