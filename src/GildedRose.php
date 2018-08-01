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
        return new static($name, $quality, $sellIn);
    }

    public function tick()
    {
        switch ($this->name) {
            case 'normal':
                return $this->normalTick();
            case 'Aged Brie':
                return $this->brieTick();
            case 'Sulfuras, Hand of Ragnaros':
                return $this->sulfurasTick();
            case 'Backstage passes to a TAFKAL80ETC concert':
                return $this->backstagePassTick();
        }
    }

    protected function normalTick()
    {
        $this->sellIn -= 1;

        if ($this->quality == 0) {
            return;
        }

        $this->quality -= 1;

        if ($this->sellIn <= 0) {
            $this->quality -= 1;
        }
    }

    protected function brieTick()
    {
        $this->sellIn -= 1;

        if ($this->quality >= 50) {
            return;
        }

        $this->quality += 1;

        if ($this->sellIn <= 0 && $this->quality < 50) {
            $this->quality += 1;
        }
    }

    protected function sulfurasTick() {}

    protected function backstagePassTick()
    {
        $this->sellIn -= 1;

        if ($this->quality >= 50) {
            return;
        }

        if ($this->sellIn < 0 ) {
            return $this->quality = 0;
        }

        $this->quality += 1;

        if ($this->sellIn < 10) {
            $this->quality += 1;
        }

        if ($this->sellIn < 5) {
            $this->quality += 1;
        }
    }
}
