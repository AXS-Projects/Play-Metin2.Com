<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('audit_logs', function (Blueprint $table) {
            $table->string('session_id')->nullable()->after('user_agent');
            $table->string('browser')->nullable()->after('session_id');
            $table->string('platform')->nullable()->after('browser');
            $table->string('location')->nullable()->after('platform');
            $table->string('username')->nullable()->after('user_id');
        });
    }

    public function down(): void
    {
        Schema::table('audit_logs', function (Blueprint $table) {
            $table->dropColumn(['session_id', 'browser', 'platform', 'location', 'username']);
        });
    }
};
