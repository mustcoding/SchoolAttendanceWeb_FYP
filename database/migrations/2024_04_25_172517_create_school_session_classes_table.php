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
        Schema::create('school_session_classes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('school_session_id');
            $table->unsignedBigInteger('class_id');
            $table->unsignedBigInteger('staff_id');
            $table->integer('is_Delete');
            $table->timestamps();

            $table->foreign('school_session_id')
                    ->references('id')
                    ->on('school_sessions');

            $table->foreign('class_id')
                    ->references('id')
                    ->on('classrooms');
            
            $table->foreign('staff_id')
                    ->references('id')
                    ->on('staff');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('school_session_classes');
    }
};
