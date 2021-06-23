<?php


namespace DaCode\DaChart\Options;

use DaCode\DaChart\Abstracts\BaseOption;
use DaCode\DaChart\Contracts\Plugin;

class Legend extends BaseOption implements Plugin
{
    public function default(): BaseOption
    {
        return $this->set('display',true)
            ->set('position','top');
    }
}