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
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->string('date_time_in');
            $table->string('date_time_out')->nullable();
            $table->integer('is_attend');
            $table->unsignedBigInteger('checkpoint_id');
            $table->unsignedBigInteger('attendance_timetable_id');
            $table->unsignedBigInteger('student_study_session_id');
            $table->timestamps();

            $table->foreign('checkpoint_id')
                    ->references('id')
                    ->on('checkpoints');

            $table->foreign('attendance_timetable_id')
                    ->references('id')
                    ->on('attendance_timetables');

            $table->foreign('student_study_session_id')
                    ->references('id')
                    ->on('student_study_sessions');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};
