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
        Schema::create('oldstudentssubjects', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('academicyear')->nullable();
            $table->tinyInteger('class_id')->nullable();
            $table->tinyInteger('semester')->nullable();
            $table->tinyInteger('subject_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('oldstudentssubjects');
    }
};
