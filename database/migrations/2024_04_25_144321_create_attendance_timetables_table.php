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
        Schema::create('attendance_timetables', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('start_time');
            $table->string('end_time');
            $table->unsignedBigInteger('occurrence_id');
            $table->integer('is_Delete');
            $table->timestamps();

            $table->foreign('occurrence_id')
                    ->references('id')
                    ->on('occurrence_types');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendance_timetables');
    }
};
