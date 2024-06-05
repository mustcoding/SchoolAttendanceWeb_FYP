<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateDocumentPathColumnSize extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('absent_supporting_documents', function (Blueprint $table) {
            $table->binary('document_path')->nullable()->change();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('absent_supporting_documents', function (Blueprint $table) {
            // If you want to revert the column size change, you can define the down method here
            // For example:
            // $table->binary('document_path')->change();
        });
    }
}
