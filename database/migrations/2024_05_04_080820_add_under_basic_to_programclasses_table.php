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
        Schema::table('programclasses', function (Blueprint $table) {
            $table->tinyInteger('under_basic')->default(1);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('programclasses', function (Blueprint $table) {
           $table->dropColumn('under_basic'); 
        });
    }
};
