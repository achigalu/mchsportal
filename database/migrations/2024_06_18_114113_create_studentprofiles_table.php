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
        Schema::create('studentprofiles', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(App\Models\User::class);
            $table->string('title');
            $table->string('initials');
            $table->string('dbirth');
            $table->string('gender');
            $table->string('marital');
            $table->string('country');
            $table->string('religion');
            $table->string('district');
            $table->string('traditional');
            $table->string('village');
            $table->string('student_phone1');
            $table->string('student_phone2');
            $table->string('student_email');
            $table->string('student_address');
            $table->string('kin_fullname');
            $table->string('relationship');
            $table->string('kin_phone');
            $table->string('kin_email');
            $table->string('kin_address');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('studentprofiles');
    }
};
