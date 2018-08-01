<?php

use App\Item;
use App\GildedRose;
use PHPUnit\Framework\TestCase;

/**
 * @covers App\GildedRose
 */
class GildedRoseTest extends TestCase
{
    /**
     * @test
     * @group Normal
     */
    public function updates_Normal_items_before_sell_date()
    {
        $item = GildedRose::of('normal', 10, 5); // quality, sell in X days

        $item->tick();

        $this->assertEquals(9, $item->quality);
        $this->assertEquals(4, $item->sellIn);
    }

    /**
     * @test
     * @group Normal
     */
    public function updates_Normal_items_on_the_sell_date()
    {
        $item = GildedRose::of('normal', 10, 0);

        $item->tick();

        $this->assertEquals(8, $item->quality);
        $this->assertEquals(-1, $item->sellIn);
    }

    /**
     * @test
     * @group Normal
     */
    public function updates_Normal_items_after_the_sell_date()
    {
        $item = GildedRose::of('normal', 10, -5);

        $item->tick();

        $this->assertEquals(8, $item->quality);
        $this->assertEquals(-6, $item->sellIn);
    }

    /**
     * @test
     * @group Normal
     */
    public function updates_Normal_items_with_a_quality_of_0()
    {
        $item = GildedRose::of('normal', 0, 5);

        $item->tick();

        $this->assertEquals(0, $item->quality);
        $this->assertEquals(4, $item->sellIn);
    }

    /**
     * @test
     * @group Brie
     */
    public function updates_Brie_items_before_the_sell_date()
    {
        $item = GildedRose::of('Aged Brie', 10, 5);

        $item->tick();

        $this->assertEquals(11, $item->quality);
        $this->assertEquals(4, $item->sellIn);
    }

    /**
     * @test
     * @group Brie
     */
    public function updates_Brie_items_before_the_sell_date_with_maximum_quality()
    {
        $item = GildedRose::of('Aged Brie', 50, 5);

        $item->tick();

        $this->assertEquals(50, $item->quality);
        $this->assertEquals(4, $item->sellIn);
    }

    /**
     * @test
     * @group Brie
     */
    public function updates_Brie_items_on_the_sell_date()
    {
        $item = GildedRose::of('Aged Brie', 10, 0);

        $item->tick();

        $this->assertEquals(12, $item->quality);
        $this->assertEquals(-1, $item->sellIn);
    }

    /**
     * @test
     * @group Brie
     */
    public function updates_Brie_items_on_the_sell_date_near_maximum_quality()
    {
        $item = GildedRose::of('Aged Brie', 49, 0);

        $item->tick();

        $this->assertEquals(50, $item->quality);
        $this->assertEquals(-1, $item->sellIn);
    }

    /**
     * @test
     * @group Brie
     */
    public function updates_Brie_items_after_the_sell_date()
    {
        $item = GildedRose::of('Aged Brie', 10, -10);

        $item->tick();

        $this->assertEquals(12, $item->quality);
        $this->assertEquals(-11, $item->sellIn);
    }

    /**
     * @test
     * @group Brie
     */
    public function updates_Brie_items_after_the_sell_date_with_maximum_quality()
    {
        $item = GildedRose::of('Aged Brie', 50, -10);

        $item->tick();

        $this->assertEquals(50, $item->quality);
        $this->assertEquals(-11, $item->sellIn);
    }

    /**
     * @test
     * @group Sulfuras
     */
    public function updates_Sulfuras_items_before_the_sell_date()
    {
        $item = GildedRose::of('Sulfuras, Hand of Ragnaros', 10, 5);

        $item->tick();

        $this->assertEquals(10, $item->quality);
        $this->assertEquals(5, $item->sellIn);
    }

    /**
     * @test
     * @group Sulfuras
     */
    public function updates_Sulfuras_items_on_the_sell_date()
    {
        $item = GildedRose::of('Sulfuras, Hand of Ragnaros', 10, 5);

        $item->tick();

        $this->assertEquals(10, $item->quality);
        $this->assertEquals(5, $item->sellIn);
    }

    /**
     * @test
     * @group Sulfuras
     */
    public function updates_Sulfuras_items_after_the_sell_date()
    {
        $item = GildedRose::of('Sulfuras, Hand of Ragnaros', 10, -1);

        $item->tick();

        $this->assertEquals(10, $item->quality);
        $this->assertEquals(-1, $item->sellIn);
    }

    /**
     * @test
     * @group Backstage pass
     */
    public function updates_Backstage_pass_items_long_before_the_sell_date()
    {
        $item = GildedRose::of('Backstage passes to a TAFKAL80ETC concert', 10, 11);

        $item->tick();

        $this->assertEquals(11, $item->quality);
        $this->assertEquals(10, $item->sellIn);
    }

    /**
     * @test
     * @group Backstage pass
     */
    public function updates_Backstage_pass_items_close_to_the_sell_date()
    {
        $item = GildedRose::of('Backstage passes to a TAFKAL80ETC concert', 10, 10);

        $item->tick();

        $this->assertEquals(12, $item->quality);
        $this->assertEquals(9, $item->sellIn);
    }

    /**
     * @test
     * @group Backstage pass
     */
    public function updates_Backstage_pass_items_close_to_the_sell_date_at_max_quality()
    {
        $item = GildedRose::of('Backstage passes to a TAFKAL80ETC concert', 50, 10);

        $item->tick();

        $this->assertEquals(50, $item->quality);
        $this->assertEquals(9, $item->sellIn);
    }

    /**
     * @test
     * @group Backstage pass
     */
    public function updates_Backstage_pass_items_very_close_to_the_sell_date()
    {
        $item = GildedRose::of('Backstage passes to a TAFKAL80ETC concert', 10, 5);

        $item->tick();

        $this->assertEquals(13, $item->quality);
        $this->assertEquals(4, $item->sellIn);
    }

    /**
     * @test
     * @group Backstage pass
     */
    public function updates_Backstage_pass_items_very_close_to_the_sell_date_at_max_quality()
    {
        $item = GildedRose::of('Backstage passes to a TAFKAL80ETC concert', 50, 5);

        $item->tick();

        $this->assertEquals(50, $item->quality);
        $this->assertEquals(4, $item->sellIn);
    }

    /**
     * @test
     * @group Backstage pass
     */
    public function updates_Backstage_pass_items_with_one_day_left_sell()
    {
        $item = GildedRose::of('Backstage passes to a TAFKAL80ETC concert', 10, 1);

        $item->tick();

        $this->assertEquals(13, $item->quality);
        $this->assertEquals(0, $item->sellIn);
    }

    /**
     * @test
     * @group Backstage pass
     */
    public function updates_Backstage_pass_items_with_one_day_left_sell_at_max_quality()
    {
        $item = GildedRose::of('Backstage passes to a TAFKAL80ETC concert', 50, 1);

        $item->tick();

        $this->assertEquals(50, $item->quality);
        $this->assertEquals(0, $item->sellIn);
    }

    /**
     * @test
     * @group Backstage pass
     */
    public function updates_Backstage_pass_items_on_the_sell_date()
    {
        $item = GildedRose::of('Backstage passes to a TAFKAL80ETC concert', 10, 0);

        $item->tick();

        $this->assertEquals(0, $item->quality);
        $this->assertEquals(-1, $item->sellIn);
    }

    /**
     * @test
     * @group Backstage pass
     */
    public function updates_Backstage_pass_items_after_the_sell_date()
    {
        $item = GildedRose::of('Backstage passes to a TAFKAL80ETC concert', 10, -1);

        $item->tick();

        $this->assertEquals(0, $item->quality);
        $this->assertEquals(-2, $item->sellIn);
    }

    // /**
    //  * @test
    //  * @group Conjured
    //  */
    // public function updates_Conjured_items_before_the_sell_date()
    // {
    //     $item = GildedRose::of('Conjured Mana Cake', 10, 10);

    //     $item->tick();

    //     $this->assertEquals(8, $item->quality);
    //     $this->assertEquals(9, $item->sellIn);
    // }

    // /**
    //  * @test
    //  * @group Conjured
    //  */
    // public function updates_Conjured_items_at_zero_quality()
    // {
    //     $item = GildedRose::of('Conjured Mana Cake', 0, 10);

    //     $item->tick();

    //     $this->assertEquals(0, $item->quality);
    //     $this->assertEquals(9, $item->sellIn);
    // }

    // /**
    //  * @test
    //  * @group Conjured
    //  */
    // public function updates_Conjured_items_on_the_sell_date()
    // {
    //     $item = GildedRose::of('Conjured Mana Cake', 10, 0);

    //     $item->tick();

    //     $this->assertEquals(6, $item->quality);
    //     $this->assertEquals(-1, $item->sellIn);
    // }

    // /**
    //  * @test
    //  * @group Conjured
    //  */
    // public function updates_Conjured_items_on_the_sell_date_at_0_quality()
    // {
    //     $item = GildedRose::of('Conjured Mana Cake', 0, 0);

    //     $item->tick();

    //     $this->assertEquals(0, $item->quality);
    //     $this->assertEquals(-1, $item->sellIn);
    // }

    // /**
    //  * @test
    //  * @group Conjured
    //  */
    // public function updates_Conjured_items_after_the_sell_date()
    // {
    //     $item = GildedRose::of('Conjured Mana Cake', 10, -10);

    //     $item->tick();

    //     $this->assertEquals(6, $item->quality);
    //     $this->assertEquals(-11, $item->sellIn);
    // }

    // /**
    //  * @test
    //  * @group Conjured
    //  */
    // public function updates_Conjured_items_after_the_sell_date_at_zero_quality()
    // {
    //     $item = GildedRose::of('Conjured Mana Cake', 0, -10);

    //     $item->tick();

    //     $this->assertEquals(0, $item->quality);
    //     $this->assertEquals(-11, $item->sellIn);
    // }
}
