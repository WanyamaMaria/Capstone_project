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
        Schema::create('services', function (Blueprint $table) {
            $table->string('service_id')->primary; // Primary key
            $table->string('facility_id'); // Foreign key

            $table->string('name');
            $table->text('description')->nullable();
            $table->string('category')->nullable();   // Machining, Testing, Training
            $table->string('skill_type')->nullable();  // Hardware, Software, Integration

            $table->timestamps();
            $table->softDeletes(); // Soft deletes

            // Foreign key constraint
            $table->foreign('facility_id')
                  ->references('facility_id')
                  ->on('facilities')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
