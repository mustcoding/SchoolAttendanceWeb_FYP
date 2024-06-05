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
        Schema::table('absent_supporting_documents', function (Blueprint $table) {
            $table->string('start_date_leave')->after('is_Delete');
            $table->string('end_date_leave')->after('start_date_leave');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('absent_supporting_documents', function (Blueprint $table) {
            //
        });
    }
};
