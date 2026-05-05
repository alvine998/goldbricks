<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->string('pic_name')->nullable()->comment('Person in charge name');
            $table->string('pic_phone')->nullable()->comment('Person in charge phone for WhatsApp');
        });
    }

    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn(['pic_name', 'pic_phone']);
        });
    }
};
