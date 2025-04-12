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
        Schema::create('course_applications', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->string('fname');
            $table->string('initials')->nullable();
            $table->string('lname');
            $table->string('sex');
            $table->integer('age');
            $table->string('dbirth');
            $table->string('marital');
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
            $table->string('kin_occupation');
            $table->string('qualification');
            $table->string('certificate_no');
            $table->integer('msce_year');
            $table->string('school_attended');
            $table->string('school_address');
            $table->tinyInteger('english_grade');
            $table->tinyInteger('maths_grade');
            $table->tinyInteger('biology_grade');
            $table->tinyInteger('pscience_grade');
            $table->tinyInteger('physics_grade');
            $table->tinyInteger('chemistry_grade');
            $table->tinyInteger('agriculture_grade');
            $table->tinyInteger('geography_grade');
            $table->tinyInteger('chichewa_grade');
            $table->tinyInteger('history_grade');
            $table->tinyInteger('bk_grade');
            $table->tinyInteger('computer_grade');
            $table->tinyInteger('admath_grade');
            $table->string('other_subjects');
            $table->tinyInteger('aggregate_grade');
            $table->string('pcertificate');
            $table->integer('pyear');
            $table->string('pcollege');
            $table->string('occupation');
            $table->string('employer');
            $table->string('workplace');
            $table->integer('choice1_program_id');
            $table->integer('choice2_program_id');
            $table->integer('choice3_program_id');
            $table->string('parent_guardian');
            $table->string('fee_sponsor');
            $table->string('fee_other');
            $table->string('cv')->nullable();
            $table->string('msce_copy');
            $table->string('bank_slip');
            $table->string('copy_pcertificate')->nullable();
            $table->string('copy_id');
            $table->string('pregistration')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_applications');
    }
};
