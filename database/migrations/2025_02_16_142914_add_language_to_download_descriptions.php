<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
	public function up()
	{
		Schema::table('download_description', function (Blueprint $table) {
			$table->string('language', 5)->default('en')->after('description'); // Adaugă limba, implicit "en"
		});
	}

	public function down()
	{
		Schema::table('download_description', function (Blueprint $table) {
			$table->dropColumn('language');
		});
	}

};
