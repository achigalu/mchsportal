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
        Schema::create('studentsubjects', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('academicyr_id');
            $table->tinyInteger('programclass_id');
            $table->tinyInteger('semester');
            $table->string('registration_no');
            $table->string('course_code');
            $table->integer('assessment1')->default(0);
            $table->integer('assessment2')->default(0);
            $table->integer('exam_grade')->default(0);
            $table->integer('final_grade')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('studentsubjects');
    }
};
