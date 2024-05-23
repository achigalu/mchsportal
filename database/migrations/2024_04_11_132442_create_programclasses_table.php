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
        Schema::create('programclasses', function (Blueprint $table) {
            $table->id();
            $table->string('classcode');
            $table->string('classname');
            $table->tinyInteger('classyear');
            $table->foreignIdFor(App\Models\Feecategory::class);
            $table->foreignIdFor(App\Models\Program::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('programclasses');
    }
};
