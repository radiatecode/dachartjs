<?php


namespace DaCode\DaChart\Options;


use DaCode\DaChart\Abstracts\BaseOption;

class Scales extends BaseOption
{
    public function default(): BaseOption
    {
        return $this->set('x.stacked', true)
            ->set('y.stacked', true);
    }
}