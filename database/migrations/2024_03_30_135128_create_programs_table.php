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
        Schema::create('programs', function (Blueprint $table) {
            $table->id();
            $table->string('short_name');
            $table->string('program_code');
            $table->string('program_name');
            $table->integer('duration');
            $table->string('program_level');
            $table->foreignIdFor(App\Models\User::class)->constrained();
            $table->foreignIdFor(App\Models\Department::class)->constrained();
            $table->foreignIdFor(App\Models\Campus::class)->constrained();
            $table->string('award');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('programs');
    }
};
