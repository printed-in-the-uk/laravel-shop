<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Jskrd\Shop\Discount;
use Jskrd\Shop\Variant;
use Tests\TestCase;

class DiscountTest extends TestCase
{
    use RefreshDatabase;

    public function testIdentifiable(): void
    {
        $uuidPattern = '/^[a-f0-9]{8}-[a-f0-9]{4}-4[a-f0-9]{3}-[89aAbB][a-f0-9]{3}-[a-f0-9]{12}$/';

        $discount = factory(Discount::class)->create();

        $this->assertRegExp($uuidPattern, $discount->id);
        $this->assertFalse($discount->incrementing);
    }

    public function testVariant(): void
    {
        $variant = factory(Variant::class)->create();

        $discount = factory(Discount::class)->create();
        $discount->variant()->associate($variant);

        $this->assertSame($variant->id, $discount->variant->id);
    }
}
