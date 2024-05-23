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
        Schema::create('myclasssubjects', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(App\Models\Programclass::class);
            $table->tinyInteger('semester');
            $table->tinyInteger('subject_id');
            $table->integer('ca_weight')->nullable();
            $table->integer('exam_weight')->nullable();
            $table->integer('pass_mark')->nullable();
            $table->string('is_project');
            $table->string('is_major');
            $table->string('category')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('myclasssubjects');
    }
};
