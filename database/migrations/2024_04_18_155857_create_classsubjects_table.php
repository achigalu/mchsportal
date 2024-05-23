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
        Schema::create('classsubjects', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(App\Models\Programclass::class);
            $table->tinyInteger('semester');
            $table->string('subject_code');
            $table->string('subject_name');
            $table->integer('CA')->nullable();
            $table->integer('pass_mark')->nullable();
            $table->string('is_project');
            $table->integer('es_exam')->nullable();
            $table->integer('final_grade')->nullable();
            $table->string('lecturers')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classsubjects');
    }
};
