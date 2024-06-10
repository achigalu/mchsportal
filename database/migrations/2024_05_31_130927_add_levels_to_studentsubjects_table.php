<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('studentsubjects', function (Blueprint $table) {
            $table->tinyInteger('access_level')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('studentsubjects', function (Blueprint $table) {
            $table->dropIfExists('access_level');
        });
    }
};
