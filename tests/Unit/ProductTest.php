<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Jskrd\Shop\Image;
use Jskrd\Shop\Product;
use Jskrd\Shop\Variant;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    public function testIdentifiable()
    {
        $uuidPattern = '/^[a-f0-9]{8}-[a-f0-9]{4}-4[a-f0-9]{3}-[89aAbB][a-f0-9]{3}-[a-f0-9]{12}$/';

        $product = factory(Product::class)->create();

        $this->assertRegExp($uuidPattern, $product->id);
        $this->assertFalse($product->incrementing);
    }

    public function testSlugifiable()
    {
        $product = factory(Product::class)->create(['name' => 'Notebook']);

        $this->assertSame('notebook', $product->slug);

        $product->update(['name' => 'Photo book']);

        $this->assertSame('photo-book', $product->slug);
    }

    public function testImages()
    {
        $image = factory(Image::class)->create();

        $product = factory(Product::class)->create();
        $product->images()->attach($image, ['position' => 9]);

        $this->assertSame($image->id, $product->images[0]->id);
        $this->assertSame(9, $product->images[0]->pivot->position);
    }

    public function testVariants()
    {
        $variant = factory(Variant::class)->make();

        $product = factory(Product::class)->create();
        $product->variants()->save($variant);

        $this->assertSame($variant->id, $product->variants[0]->id);
    }
}
