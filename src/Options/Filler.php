<?php


namespace DaCode\DaChart\Options;


use DaCode\DaChart\Abstracts\BaseOption;
use DaCode\DaChart\Contracts\Plugin;

class Filler extends BaseOption implements Plugin
{
    protected function default(): BaseOption
    {
        return $this->set('propagate',false);
    }

}