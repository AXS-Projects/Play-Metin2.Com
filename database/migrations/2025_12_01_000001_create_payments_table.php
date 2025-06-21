<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('metin2_user_id');
            $table->unsignedBigInteger('payment_package_id');
            $table->string('stripe_session_id')->nullable();
            $table->string('status')->default('pending');
            $table->decimal('amount', 8, 2);
            $table->integer('coins');
            $table->string('ip_address', 45)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
