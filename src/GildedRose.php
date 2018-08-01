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

        if ($this->name != 'Aged Brie' and $this->name != 'Backstage passes to a TAFKAL80ETC concert') {
            if ($this->quality > 0) {
                if ($this->name != 'Sulfuras, Hand of Ragnaros') {
                    $this->quality = $this->quality - 1;
                }
            }
        } else {
            if ($this->quality < 50) {
                $this->quality = $this->quality + 1;

                if ($this->name == 'Backstage passes to a TAFKAL80ETC concert') {
                    if ($this->sellIn < 11) {
                        if ($this->quality < 50) {
                            $this->quality = $this->quality + 1;
                        }
                    }
                    if ($this->sellIn < 6) {
                        if ($this->quality < 50) {
                            $this->quality = $this->quality + 1;
                        }
                    }
                }
            }
        }

        if ($this->name != 'Sulfuras, Hand of Ragnaros') {
            $this->sellIn = $this->sellIn - 1;
        }

        if ($this->sellIn < 0) {
            if ($this->name != 'Aged Brie') {
                if ($this->name != 'Backstage passes to a TAFKAL80ETC concert') {
                    if ($this->quality > 0) {
                        if ($this->name != 'Sulfuras, Hand of Ragnaros') {
                            $this->quality = $this->quality - 1;
                        }
                    }
                } else {
                    $this->quality = $this->quality - $this->quality;
                }
            } else {
                if ($this->quality < 50) {
                    $this->quality = $this->quality + 1;
                }
            }
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
