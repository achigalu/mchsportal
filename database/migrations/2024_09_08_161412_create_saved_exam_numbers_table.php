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
        Schema::create('saved_exam_numbers', function (Blueprint $table) {
            $table->id();
            $table->string('pcode');
            $table->string('exam_number');
            $table->tinyInteger('semester');
            $table->tinyInteger('acdyear');
            $table->string('campus');
            $table->string('reg_num');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('saved_exam_numbers');
    }
};
