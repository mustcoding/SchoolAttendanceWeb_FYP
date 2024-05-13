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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->date('date_of_birth');
            $table->unsignedBigInteger('parent_guardian_id');
            $table->unsignedBigInteger('card_rfid');
            $table->unsignedBigInteger('tag_rfid');
            $table->integer('is_Delete');
            $table->timestamps();

            $table->foreign('parent_guardian_id')
                    ->references('id')
                    ->on('parent_guardians');

            $table->foreign('card_rfid')
                    ->references('id')
                    ->on('rfids');

            $table->foreign('tag_rfid')
                    ->references('id')
                    ->on('rfids');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
