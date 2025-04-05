<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique(); // Numele categoriei (ex: Weapons, Armor)
            $table->string('slug')->unique(); // Slug unic pentru categorie (ex: weapons, armor)
            $table->string('icon')->nullable(); // Iconița categoriei (ex: ⚔️, 🛡️)
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('categories');
    }
};
