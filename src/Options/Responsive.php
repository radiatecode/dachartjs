<?php


namespace DaCode\DaChart\Options;


use DaCode\DaChart\Abstracts\BaseOption;
class Responsive extends BaseOption
{
    public function default(): BaseOption
    {
        return $this->set('',true);
    }
}