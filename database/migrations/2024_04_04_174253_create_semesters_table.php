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
        Schema::create('semesters', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(App\Models\Academicyear::class)->constrained();
            $table->tinyInteger('semester');
            $table->date('ssdate');
            $table->date('sedate');
            $table->date('rsdate');
            $table->date('redate');
            $table->tinyInteger('is_semester_final');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('semesters');
    }
};
