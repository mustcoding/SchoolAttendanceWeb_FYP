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
        Schema::create('student_study_sessions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('ssc_id');
            $table->integer('is_Delete');
            $table->timestamps();

            $table->foreign('student_id')
                    ->references('id')
                    ->on('students');

            $table->foreign('ssc_id')
                    ->references('id')
                    ->on('school_session_classes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_study_sessions');
    }
};
