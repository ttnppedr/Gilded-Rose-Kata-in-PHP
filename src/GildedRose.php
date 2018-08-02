<?php

namespace App;

class GildedRose
{
    public $name;

    public $quality;

    public $sellIn;

    public function __construct($name, $quality, $sellIn)
    {
        $this->name = $name;
        $this->quality = $quality;
        $this->sellIn = $sellIn;
    }

    public static function of($name, $quality, $sellIn) {
        $lookup = [
            'normal' => Normal::class,
            'Aged Brie' => Brie::class,
            'Sulfuras, Hand of Ragnaros' => Sulfuras::class,
            'Backstage passes to a TAFKAL80ETC concert' => BackstagePass::class,
        ];

        return new $lookup[$name]($quality, $sellIn);
    }
}
