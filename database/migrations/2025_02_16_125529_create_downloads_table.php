<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('downloads', function (Blueprint $table) {
            $table->id();
            $table->string('site_name'); // Ex: Mega.co.nz, Google Drive
            $table->string('download_link'); // Linkul efectiv
            $table->timestamps();
        });

        Schema::create('download_description', function (Blueprint $table) {
            $table->id();
            $table->text('description'); // Poate conține sistem requirements, info
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('downloads');
        Schema::dropIfExists('download_description');
    }
};
