<?php
/**
 * Created by PhpStorm.
 * User: AndreasAnemyr
 * Date: 2015-10-27
 * Time: 12:30
 */

namespace controller;


class Master
{
    private $index;
    private $dal;

    public function __construct(\View\Index $index)
    {
        $this->index = $index;
        $this->dal = new \Model\Dal();
        $this->dal->load();
    }

    public function doApplication()
    {
        $this->index->GetPage($this->dal);

        $this->dal->save();
    }
}