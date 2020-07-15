<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Jskrd\Shop\Basket;
use Jskrd\Shop\Image;
use Jskrd\Shop\Product;
use Jskrd\Shop\Variant;
use Jskrd\Shop\Zone;
use Tests\TestCase;

class VariantTest extends TestCase
{
    use RefreshDatabase;

    public function testIdentifiable()
    {
        $uuidPattern = '/^[a-f0-9]{8}-[a-f0-9]{4}-4[a-f0-9]{3}-[89aAbB][a-f0-9]{3}-[a-f0-9]{12}$/';

        $variant = factory(Variant::class)->create();

        $this->assertRegExp($uuidPattern, $variant->id);
        $this->assertFalse($variant->incrementing);
    }

    public function testSlugifiable()
    {
        $variant = factory(Variant::class)
            ->create(['name' => 'Notebook (Hardcover, Plain)']);

        $this->assertSame('notebook-hardcover-plain', $variant->slug);

        $variant->update(['name' => 'Notebook (Hardcover, Blank)']);

        $this->assertSame('notebook-hardcover-blank', $variant->slug);
    }

    public function testBaskets()
    {
        $basket = factory(Basket::class)->create();

        $variant = factory(Variant::class)->create();
        $variant->baskets()->attach($basket, [
            'quantity' => 9,
            'price' => 2897,
            'delivery_cost' => 888,
        ]);

        $this->assertSame($basket->id, $variant->baskets[0]->id);
        $this->assertSame(9, $variant->baskets[0]->pivot->quantity);
        $this->assertSame(2897, $variant->baskets[0]->pivot->price);
        $this->assertSame(888, $variant->baskets[0]->pivot->delivery_cost);
    }

    public function testImages()
    {
        $image = factory(Image::class)->create();

        $variant = factory(Variant::class)->create();
        $variant->images()->attach($image, ['position' => 1]);

        $this->assertSame($image->id, $variant->images[0]->id);
        $this->assertSame(1, $variant->images[0]->pivot->position);
    }

    public function testProduct()
    {
        $product = factory(Product::class)->create();

        $variant = factory(Variant::class)->create();
        $variant->product()->associate($product);

        $this->assertSame($product->id, $variant->product->id);
    }

    public function testZones()
    {
        $zone = factory(Zone::class)->create();

        $variant = factory(Variant::class)->create();
        $variant->zones()->attach($zone, ['delivery_cost' => 915]);

        $this->assertSame($zone->id, $variant->zones[0]->id);
        $this->assertSame(915, $variant->zones[0]->pivot->delivery_cost);
    }
}
