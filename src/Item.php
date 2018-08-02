<?php

namespace App;

abstract class Item
{
    public $quality;
    public $sellIn;

    public function __construct($quality, $sellIn)
    {
        $this->quality = $quality;
        $this->sellIn = $sellIn;
    }

    abstract public function tick();
}
