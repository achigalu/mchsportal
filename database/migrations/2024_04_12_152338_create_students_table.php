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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(App\Models\Academicyear::class);
            $table->foreignIdFor(App\Models\Programclass::class);
            $table->string('reg_no');
            $table->string('fname');
            $table->string('lname');
            $table->string('email')->unique();
            $table->date('dob')->nullable();
            $table->string('entry_level');
            $table->string('campus');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
