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
        Schema::create('absent_supporting_documents', function (Blueprint $table) {
            $table->id();
            $table->string('file_name');
            $table->binary('document_path');
            $table->dateTime('uploaded_date_time');
            $table->string('verification_status');
            $table->dateTime('verified_date_time');
            $table->string('reason');
            $table->unsignedBigInteger('parent_guardian_id');
            $table->unsignedBigInteger('staff_id');
            $table->integer('is_Delete');
            $table->timestamps();

            $table->foreign('parent_guardian_id')
                    ->references('id')
                    ->on('parent_guardians');

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
        Schema::dropIfExists('absent_supporting_documents');
    }
};
