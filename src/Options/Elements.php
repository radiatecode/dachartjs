<?php


namespace DaCode\DaChart\Options;


use DaCode\DaChart\Abstracts\BaseOption;

class Elements extends BaseOption
{
    protected function default(): BaseOption
    {
        return $this->set('bar', ['borderWidth' => 2]);
    }

}