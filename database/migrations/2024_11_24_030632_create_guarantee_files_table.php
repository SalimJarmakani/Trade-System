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
        Schema::create('guarantee_files', function (Blueprint $table) {
            $table->id();
            $table->string('corporate_reference_number'); // Corporate Reference Number
            $table->enum('file_type', ['csv', 'xml', 'json']); // File Type
            $table->binary('file_content'); // File Content as BLOB
            $table->timestamps();

            // Foreign key constraint to guarantees table
            $table->foreign('corporate_reference_number')
                ->references('corporate_reference_number')
                ->on('guarantees')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guarantee_files');
    }
};
