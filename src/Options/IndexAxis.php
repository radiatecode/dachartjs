<?php


namespace DaCode\DaChart\Options;

use DaCode\DaChart\Abstracts\BaseOption;

class IndexAxis extends BaseOption
{
    public function default(): BaseOption
    {
        return $this->set('','x');
    }
}