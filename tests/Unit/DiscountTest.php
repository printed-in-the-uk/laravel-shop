<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Jskrd\Shop\Discount;
use Jskrd\Shop\Variant;
use Tests\TestCase;

class DiscountTest extends TestCase
{
    use RefreshDatabase;

    public function testVariant(): void
    {
        $variant = factory(Variant::class)->create();

        $discount = factory(Discount::class)->create();
        $discount->variant()->associate($variant);

        $this->assertSame($variant->id, $discount->variant->id);
    }
}
