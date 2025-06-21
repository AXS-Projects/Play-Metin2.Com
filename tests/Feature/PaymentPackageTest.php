<?php

namespace Tests\Feature;

use App\Models\PaymentPackage;
use Tests\TestCase;

class PaymentPackageTest extends TestCase
{
    public function test_package_creation(): void
    {
        $package = PaymentPackage::create([
            'name' => 'Small Pack',
            'coins' => 100,
            'price' => 9.99,
            'currency' => 'EUR',
        ]);

        $this->assertDatabaseHas('payment_packages', [
            'id' => $package->id,
            'coins' => 100,
        ]);
    }
}
