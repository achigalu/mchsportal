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
        Schema::create('registrations', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('student_id');
            $table->tinyInteger('dep_id');
            $table->tinyInteger('program_id');
            $table->tinyInteger('class_id');
            $table->tinyInteger('campus_id');
            $table->tinyInteger('under_basic')->default(0);
            $table->tinyInteger('registration')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registrations');
    }
};
