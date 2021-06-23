<?php


namespace DaCode\DaChart\Options;


use DaCode\DaChart\Abstracts\BaseOption;

class Stacked extends BaseOption
{
    protected function default(): BaseOption
    {
        return $this->set('',false);
    }

}