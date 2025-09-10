<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->string('projectId')->primary();
            $table->string('facility_id');
            $table->foreign('facility_id')->references('facilityId')->on('facilities')->onDelete('cascade');
            $table->string('program_id');
            $table->foreign('program_id')->references('programId')->on('programs')->onDelete('cascade');
            $table->string('name');
            $table->text('description')->nullable();
            $table->timestamps();
});

    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
