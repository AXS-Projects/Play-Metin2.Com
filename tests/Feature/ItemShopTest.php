<?php

namespace Tests\Feature;

use Tests\TestCase;

class ItemShopTest extends TestCase
{
    public function test_itemshop_requires_authentication(): void
    {
        $response = $this->get('/itemshop');

        $response->assertRedirect('/');
    }
}
