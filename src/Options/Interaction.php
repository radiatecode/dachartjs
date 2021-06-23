<?php


namespace DaCode\DaChart\Options;


use DaCode\DaChart\Abstracts\BaseOption;

class Interaction extends BaseOption
{
    public function default(): BaseOption
    {
        return $this->set('intersect',false)
            ->set('mode','point')
            ->set('axis','x');
    }
}