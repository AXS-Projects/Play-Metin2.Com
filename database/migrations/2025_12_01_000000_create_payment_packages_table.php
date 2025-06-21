<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payment_packages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('coins');
            $table->decimal('price', 8, 2);
            $table->string('currency', 3)->default('EUR');
            $table->string('stripe_price_id')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payment_packages');
    }
};
