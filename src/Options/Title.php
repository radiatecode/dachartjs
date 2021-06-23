<?php


namespace DaCode\DaChart\Options;

use DaCode\DaChart\Abstracts\BaseOption;
use DaCode\DaChart\Contracts\Plugin;

class Title extends BaseOption implements Plugin
{
    protected function default(): BaseOption
    {
        return $this->set('text','My Chart')
            ->set('position','top')
            ->set('display',true)
            ->set('color','black');
    }
}