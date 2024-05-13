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
        Schema::create('student_images', function (Blueprint $table) {
            $table->id();
            $table->binary('image')->nullable();
            $table->integer('is_official');
            $table->unsignedBigInteger('student_id');
            $table->timestamps();

            $table->foreign('student_id')
                    ->references('id')
                    ->on('students');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_images');
    }
};
