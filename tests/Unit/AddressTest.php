<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Jskrd\Shop\Address;
use Tests\TestCase;

class AddressTest extends TestCase
{
    use RefreshDatabase;

    public function testIdentifiable(): void
    {
        $uuidPattern = '/^[a-f0-9]{8}-[a-f0-9]{4}-4[a-f0-9]{3}-[89aAbB][a-f0-9]{3}-[a-f0-9]{12}$/';

        $address = factory(Address::class)->create();

        $this->assertRegExp($uuidPattern, $address->id);
        $this->assertFalse($address->incrementing);
    }
}
